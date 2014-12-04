<?php

namespace Bellcom\ServerInfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Bellcom\ServerInfoBundle\Entity\Server;
use Bellcom\ServerInfoBundle\Entity\Mails;
use Bellcom\ServerInfoBundle\Entity\Vhost;
use Bellcom\ServerInfoBundle\Entity\VhostDomain;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

  /**
   * @Route("/post")
   */
  public function PostAction()
  {
    $request = $this->get('request');
    if ($request->getMethod() == 'POST') {
      $postdata = unserialize(base64_decode($request->request->get('data')));

      # TODO check for empty fqdn (if empty, maybe create if from hostname and domainsname). If still empty, die

      # set doctrine manager
      $em = $this->getDoctrine()->getManager();

      # if the server is already created, load the object. else create a new
      $server = $this->getDoctrine()
        ->getRepository('BellcomServerInfoBundle:Server')
        ->findOneByFqdn($postdata['fqdn']);
      if ( !($server instanceof Server) ) {
        $server = new Server();
        $server->setCreated(time());

        # TODO, also send the mails if the server is created from the dom0 first
        # send a mail
        $message = \Swift_Message::newInstance()
          ->setSubject('ServerInfo: New Server Created')
          ->setFrom('domains@bellcom.dk')
          ->setTo('mmh@bellcom.dk')
          ->setBody($postdata['fqdn'] . ' created');
        $this->get('mailer')->send($message);
      }

      $server->setManual(false);
      $server->setHostname($postdata['hostname']);
      $server->setUpdated(time());
      $server->setFqdn($postdata['fqdn']);
      $server->setMemory($postdata['memory']);
      $server->setIntIp($postdata['ipaddress']);
      if (!empty($postdata['external_ip'])) {
        $server->setExtIp($postdata['external_ip']);
        #$server->setExtIp(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $postdata['external_ip'] ) ? $postdata['external_ip'] : '');
      }
      $server->setCpucount($postdata['processorcount']);
      $server->setCpuinfo($postdata['processor0']);
      $server->setIsvirtual($postdata['virtual']);
      $server->setUptime($postdata['uptime']);
      $server->setSoftwareUpdates(!empty($postdata['software_updates']) ? serialize( $postdata['software_updates'] ) : null);
      $server->setOs($postdata['lsbdistid']);
      $server->setKernelRelease($postdata['kernelrelease']);
      $server->setOsRelease($postdata['lsbdistrelease']);
      $server->setArch($postdata['arch']);
      $server->setKernelarch($postdata['architecture']); // could also use $postdata['hardwaremodel'] for a different vay to write it
      if (!empty($postdata['ipmi_ip'])) {
        $server->setIpmiIp($postdata['ipmi_ip']);
      }
      if (!empty($postdata['network_speed'])) {
        $server->setNetworkSpeed($postdata['network_speed']);
      }

      # handle the numbers of dom0 and other servers with digits
      if (preg_match('#[\d]#',$postdata['hostname'])) {
        $servernumber = filter_var($postdata['hostname'],FILTER_SANITIZE_NUMBER_INT);
        $server->setServernumber($servernumber);
      }

      # hadle domU / dom0 and parents
      if ( $server->getIsvirtual() === 'xen0' ) {
        $server->setDom0freemem($postdata['dom0freemem']);
        $server->setDom0totalmem($postdata['dom0totalmem']);
      }
      if ( $server->getIsvirtual() === 'xen0' && isset($postdata['domUs']) && !empty($postdata['domUs']) )
      {
        foreach ($postdata['domUs'] as $domUName) {
          $domU = $this->getDoctrine()
            ->getRepository('BellcomServerInfoBundle:Server')
            ->findOneByHostname($domUName);

          if ( ! $domU instanceof Server) {
            # a domU child from a dom0 havent been created as a server (yet). Create it as manual
            $domU = new Server();
            $domU->setCreated(time());
            $domU->setManual(true);
            $domU->setFqdn($domUName.".bellcom.dk");
            $domU->setCpuinfo($postdata['processor0']);
            $domU->setIsvirtual("xenu");
            $domU->setHostname($domUName);
          }
          # should we set a new updated time here? only parent is updated, and there is no garantee of a post from the domu itself
          $domU->setUpdated(time());
          $domU->setParent($postdata['hostname']);

          $em->persist($domU);
        }
      }

      # handle mails sent, -1 used as special value for servers that cant report (iredmail, etch)
      if ($postdata['mailssent'] != -1) {
        $mails = $this->getDoctrine()
          ->getRepository('BellcomServerInfoBundle:Mails')
          ->findOneBy(array('server' => $server->getId(), 'date' => new \DateTime('now')));
        if ( !($mails instanceof Mails) ) {
          $mails = new Mails();
        }
        $mails->setDate(new \DateTime('now'));
        $mails->setNumberMails($postdata['mailssent']);
        $mails->setServer($server);
      }

      # handle vhosts
      if (isset($postdata['vhosts'])) {
        foreach ($postdata['vhosts'] as $v) {
          # searching for port too. Could also remove port and instead add it to a list of ports the vhost uses?
          $vhost = $this->getDoctrine()
            ->getRepository('BellcomServerInfoBundle:Vhost')
            ->findOneBy(array('server' => $server->getId(), 'server_name' => $v['servername'], 'port' =>  $v['port']));
          if ( !($vhost instanceof Vhost) ) {
            $vhost = new Vhost();
            $vhost->setServerName($v['servername']);
            $vhost->setCreated(time());
          }
          $vhost->setUpdated(time());
          $vhost->setFileName(isset($v['filename']) ? $v['filename'] : null);
          $vhost->setDocumentRoot(isset($v['documentroot']) ? $v['documentroot'] : null);
          $vhost->setServerAdmin(isset($v['serveradmin']) ? $v['serveradmin'] : null);
          $vhost->setServer($server);
          $vhost->setPort(isset($v['port']) ? $v['port'] : null);
          $em->persist($vhost);
          foreach ($v['domains'] as $domain) {
            $vhostdomain = $this->getDoctrine()
              ->getRepository('BellcomServerInfoBundle:VhostDomain')
              ->findOneBy(array('vhost' => $vhost->getId(), 'domain_name' => $domain['name']));
            if ( !($vhostdomain instanceof VhostDomain) ) {
              $vhostdomain = new VhostDomain();
              $vhostdomain->setDomainName($domain['name']);
              $vhostdomain->setCreated(time());
            }
            $vhostdomain->setUpdated(time());
            $vhostdomain->setType($domain['type']);
            $vhostdomain->setVhost($vhost);
            $em->persist($vhostdomain);
          }
        }
      }

      $em->persist($server);
      if (isset($mails)) {
        $em->persist($mails);
      }
      $em->flush();
      return new Response('');
      #return new Response('Created or updated server '.$server->getHostname());
    }
  }

  /**
   * @Route("/viewall")
   * @Template()
   */
  public function ViewAllAction()
  {
    $too_old = time() - 432000; // 432000 seconds is 5 days

# one way to create the query
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
    'SELECT s FROM BellcomServerInfoBundle:Server s WHERE s.updated > :updated'
    )->setParameter('updated', $too_old);

//    # another way
//    $repository = $this->getDoctrine()
//      ->getRepository('BellcomServerInfoBundle:Server');
//    $query = $repository->createQueryBuilder('server')
//#      ->where('server.updated > '.$too_old) #this doesnt work anyway - only 1 where
//      ->where('server.manual = false')
//      ->getQuery();
//#      ->setMaxResults( '2' );

    $servers = $query->getResult();

# unserialize software_updates
    foreach ($servers as $server) {
      $server->setSoftwareUpdates(unserialize($server->getSoftwareUpdates()));
    }

# this will just return all servers
#    $servers = $this->getDoctrine()
#      ->getRepository('BellcomServerInfoBundle:Server')
#      ->findAll();


    return $this->render('BellcomServerInfoBundle:Server:viewall.html.twig', array(
          'servers' => $servers,
          ));
  }

  /**
   * @Route("/viewxen")
   * @Template()
   */
  public function ViewXenAction()
  {

    $too_old = time() - 432000; // 432000 seconds is 5 days
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
    #'SELECT s, SUBSTRING( s.hostname, 4 ) AS xennumber FROM BellcomServerInfoBundle:Server s WHERE s.updated > :updated AND s.isvirtual = :isvirtual ORDER BY ABS( xennumber ) ASC'
    'SELECT s FROM BellcomServerInfoBundle:Server s WHERE s.updated > :updated AND s.isvirtual = :isvirtual AND s.manual = :manual ORDER BY s.servernumber ASC'
    )->setParameters(array(
      'updated' => $too_old,
      'isvirtual' => 'xen0',
      'manual' => 'false'));

//    $repository = $this->getDoctrine()
//      ->getRepository('BellcomServerInfoBundle:Server');
//
//    $query = $repository->createQueryBuilder('server')
//      ->where('server.updated > '.$too_old)
//      ->where("server.isvirtual = 'xen0'")
//      ->orderBy('server.servernumber', 'ASC')
//      ->getQuery();

    $xenservers = $query->getResult();

    return $this->render('BellcomServerInfoBundle:Server:viewxen.html.twig', array(
      'servers' => $xenservers,
      ));
  }
}

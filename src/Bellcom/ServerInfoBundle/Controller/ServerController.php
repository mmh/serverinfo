<?php

namespace Bellcom\ServerInfoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServerController extends Controller
{
  public function domUTableAction($dom0name)
  {
    $too_old = time() - 432000; // 432000 seconds is 5 days

// this way doesnt seem to work
//    $repository = $this->getDoctrine()
//      ->getRepository('BellcomServerInfoBundle:Server');
//    $query = $repository->createQueryBuilder('server')
//      ->where('server.updated > '.$too_old)
//      #->where('server.parent = '.$dom0name)
//      ->where('server.parent = '.$dom0name)
//      ->getQuery();

    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
    'SELECT s FROM BellcomServerInfoBundle:Server s WHERE s.updated > :updated AND s.parent = :parent'
    )->setParameters(array(
      'updated' => $too_old,
      'parent' => $dom0name));

    $servers = $query->getResult();

    return $this->render('BellcomServerInfoBundle:Server:domutable.html.twig', array('servers' => $servers));
  }
}

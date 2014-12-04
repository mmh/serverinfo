<?php
namespace Bellcom\ServerInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="server")
 */
class Server
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $hostname;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $fqdn;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $int_ip;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $ext_ip;

    /**
     * @ORM\Column(type="integer")
     */
    protected $created;

    /**
     * @ORM\Column(type="integer")
     */
    protected $updated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $memory;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cpucount;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $cpuinfo;

    /**
     * @ORM\Column(type="string", length=100, nullable=true))
     */
    protected $kernel_release;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $os;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $os_release;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $arch;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $kernelarch;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $isvirtual;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $servernumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $dom0freemem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $dom0totalmem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $uptime;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $software_updates;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $parent;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $ipmi_ip;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $network_speed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $manual;

    /**
     * @ORM\OneToMany(targetEntity="Mails", mappedBy="server", cascade={"remove"})
     */
    protected $mails;

    /**
     * @ORM\OneToMany(targetEntity="Vhost", mappedBy="server", cascade={"remove"})
     */
    protected $vhosts;


    public function __construct()
    {
        $this->mails = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Server
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set memory
     *
     * @param float $memory
     * @return Server
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Get memory
     *
     * @return float
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Server
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set fqdn
     *
     * @param string $fqdn
     * @return Server
     */
    public function setFqdn($fqdn)
    {
        $this->fqdn = $fqdn;

        return $this;
    }

    /**
     * Get fqdn
     *
     * @return string
     */
    public function getFqdn()
    {
        return $this->fqdn;
    }

    /**
     * Set int_ip
     *
     * @param string $intIp
     * @return Server
     */
    public function setIntIp($intIp)
    {
        $this->int_ip = $intIp;

        return $this;
    }

    /**
     * Get int_ip
     *
     * @return string
     */
    public function getIntIp()
    {
        return $this->int_ip;
    }

    /**
     * Set ext_ip
     *
     * @param string $extIp
     * @return Server
     */
    public function setExtIp($extIp)
    {
        $this->ext_ip = $extIp;

        return $this;
    }

    /**
     * Get ext_ip
     *
     * @return string
     */
    public function getExtIp()
    {
        return $this->ext_ip;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     * @return Server
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Server
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     * @return Server
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set cpucount
     *
     * @param integer $cpucount
     * @return Server
     */
    public function setCpucount($cpucount)
    {
        $this->cpucount = $cpucount;

        return $this;
    }

    /**
     * Get cpucount
     *
     * @return integer
     */
    public function getCpucount()
    {
        return $this->cpucount;
    }

    /**
     * Set cpuinfo
     *
     * @param string $cpuinfo
     * @return Server
     */
    public function setCpuinfo($cpuinfo)
    {
        $this->cpuinfo = $cpuinfo;

        return $this;
    }

    /**
     * Get cpuinfo
     *
     * @return string
     */
    public function getCpuinfo()
    {
        return $this->cpuinfo;
    }

    /**
     * Set kernel_release
     *
     * @param string $kernelRelease
     * @return Server
     */
    public function setKernelRelease($kernelRelease)
    {
        $this->kernel_release = $kernelRelease;

        return $this;
    }

    /**
     * Get kernel_release
     *
     * @return string
     */
    public function getKernelRelease()
    {
        return $this->kernel_release;
    }

    /**
     * Set os
     *
     * @param string $os
     * @return Server
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set os_release
     *
     * @param string $osRelease
     * @return Server
     */
    public function setOsRelease($osRelease)
    {
        $this->os_release = $osRelease;

        return $this;
    }

    /**
     * Get os_release
     *
     * @return string
     */
    public function getOsRelease()
    {
        return $this->os_release;
    }

    /**
     * Set arch
     *
     * @param string $arch
     * @return Server
     */
    public function setArch($arch)
    {
        $this->arch = $arch;

        return $this;
    }

    /**
     * Get arch
     *
     * @return string
     */
    public function getArch()
    {
        return $this->arch;
    }

    /**
     * Set isvirtual
     *
     * @param string $isvirtual
     * @return Server
     */
    public function setIsvirtual($isvirtual)
    {
        $this->isvirtual = $isvirtual;

        return $this;
    }

    /**
     * Get isvirtual
     *
     * @return string
     */
    public function getIsvirtual()
    {
        return $this->isvirtual;
    }

    /**
     * Set uptime
     *
     * @param integer $uptime
     * @return Server
     */
    public function setUptime($uptime)
    {
        $this->uptime = $uptime;

        return $this;
    }

    /**
     * Get uptime
     *
     * @return integer
     */
    public function getUptime()
    {
        return $this->uptime;
    }

    /**
     * Set software_updates
     *
     * @param string $softwareUpdates
     * @return Server
     */
    public function setSoftwareUpdates($softwareUpdates)
    {
        $this->software_updates = $softwareUpdates;

        return $this;
    }

    /**
     * Get software_updates
     *
     * @return string
     */
    public function getSoftwareUpdates()
    {
        return $this->software_updates;
    }

    /**
     * Set parent
     *
     * @param string $parent
     * @return Server
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set kernelarch
     *
     * @param string $kernelarch
     * @return Server
     */
    public function setKernelarch($kernelarch)
    {
        $this->kernelarch = $kernelarch;

        return $this;
    }

    /**
     * Get kernelarch
     *
     * @return string
     */
    public function getKernelarch()
    {
        return $this->kernelarch;
    }

    /**
     * Set dom0freemem
     *
     * @param integer $dom0freemem
     * @return Server
     */
    public function setDom0freemem($dom0freemem)
    {
        $this->dom0freemem = $dom0freemem;

        return $this;
    }

    /**
     * Get dom0freemem
     *
     * @return integer
     */
    public function getDom0freemem()
    {
        return $this->dom0freemem;
    }

    /**
     * Set servernumber
     *
     * @param integer $servernumber
     * @return Server
     */
    public function setServernumber($servernumber)
    {
        $this->servernumber = $servernumber;

        return $this;
    }

    /**
     * Get servernumber
     *
     * @return integer
     */
    public function getServernumber()
    {
        return $this->servernumber;
    }

    /**
     * Set dom0totalmem
     *
     * @param integer $dom0totalmem
     * @return Server
     */
    public function setDom0totalmem($dom0totalmem)
    {
        $this->dom0totalmem = $dom0totalmem;

        return $this;
    }

    /**
     * Get dom0totalmem
     *
     * @return integer
     */
    public function getDom0totalmem()
    {
        return $this->dom0totalmem;
    }

    /**
     * Set manual
     *
     * @param boolean $manual
     * @return Server
     */
    public function setManual($manual)
    {
        $this->manual = $manual;

        return $this;
    }

    /**
     * Get manual
     *
     * @return boolean
     */
    public function getManual()
    {
        return $this->manual;
    }

    /**
     * Add mails
     *
     * @param Bellcom\ServerInfoBundle\Entity\Mails $mails
     * @return Server
     */
    public function addMail(\Bellcom\ServerInfoBundle\Entity\Mails $mails)
    {
        $this->mails[] = $mails;

        return $this;
    }

    /**
     * Remove mails
     *
     * @param Bellcom\ServerInfoBundle\Entity\Mails $mails
     */
    public function removeMail(\Bellcom\ServerInfoBundle\Entity\Mails $mails)
    {
        $this->mails->removeElement($mails);
    }

    /**
     * Get mails
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getMails()
    {
        return $this->mails;
    }

    /**
     * Add vhosts
     *
     * @param Bellcom\ServerInfoBundle\Entity\Vhost $vhosts
     * @return Server
     */
    public function addVhost(\Bellcom\ServerInfoBundle\Entity\Vhost $vhosts)
    {
        $this->vhosts[] = $vhosts;

        return $this;
    }

    /**
     * Remove vhosts
     *
     * @param Bellcom\ServerInfoBundle\Entity\Vhost $vhosts
     */
    public function removeVhost(\Bellcom\ServerInfoBundle\Entity\Vhost $vhosts)
    {
        $this->vhosts->removeElement($vhosts);
    }

    /**
     * Get vhosts
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getVhosts()
    {
        return $this->vhosts;
    }

    /**
     * Set ipmi_ip
     *
     * @param string $ipmiIp
     * @return Server
     */
    public function setIpmiIp($ipmiIp)
    {
        $this->ipmi_ip = $ipmiIp;

        return $this;
    }

    /**
     * Get ipmi_ip
     *
     * @return string
     */
    public function getIpmiIp()
    {
        return $this->ipmi_ip;
    }

    /**
     * Set network_speed
     *
     * @param integer $networkSpeed
     * @return Server
     */
    public function setNetworkSpeed($networkSpeed)
    {
        $this->network_speed = $networkSpeed;

        return $this;
    }

    /**
     * Get network_speed
     *
     * @return integer
     */
    public function getNetworkSpeed()
    {
        return $this->network_speed;
    }
}

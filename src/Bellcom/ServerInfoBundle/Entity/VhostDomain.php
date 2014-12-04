<?php
namespace Bellcom\ServerInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="vhostdomain")
 */
class VhostDomain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $domain_name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $created;

    /**
     * @ORM\Column(type="integer")
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Vhost", inversedBy="vhost", cascade={"remove"})
     * @ORM\JoinColumn(name="vhost_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $vhost;


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
     * Set domain_name
     *
     * @param string $domainName
     * @return VhostDomain
     */
    public function setDomainName($domainName)
    {
        $this->domain_name = $domainName;

        return $this;
    }

    /**
     * Get domain_name
     *
     * @return string
     */
    public function getDomainName()
    {
        return $this->domain_name;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return VhostDomain
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return VhostDomain
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
     * @return VhostDomain
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
     * Set vhost
     *
     * @param Bellcom\ServerInfoBundle\Entity\Vhost $vhost
     * @return VhostDomain
     */
    public function setVhost(\Bellcom\ServerInfoBundle\Entity\Vhost $vhost = null)
    {
        $this->vhost = $vhost;

        return $this;
    }

    /**
     * Get vhost
     *
     * @return Bellcom\ServerInfoBundle\Entity\Vhost
     */
    public function getVhost()
    {
        return $this->vhost;
    }
}

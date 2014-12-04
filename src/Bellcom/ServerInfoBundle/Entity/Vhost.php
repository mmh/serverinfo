<?php
namespace Bellcom\ServerInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="vhost")
 */
class Vhost
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
    protected $server_name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $file_name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $document_root;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $server_admin;

    /**
     * @ORM\Column(type="integer")
     */
    protected $port;

    /**
     * @ORM\Column(type="integer")
     */
    protected $created;

    /**
     * @ORM\Column(type="integer")
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Server", inversedBy="servers", cascade={"remove"})
     * @ORM\JoinColumn(name="server_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $server;



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
     * Set server_name
     *
     * @param string $serverName
     * @return Vhost
     */
    public function setServerName($serverName)
    {
        $this->server_name = $serverName;

        return $this;
    }

    /**
     * Get server_name
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->server_name;
    }

    /**
     * Set file_name
     *
     * @param string $fileName
     * @return Vhost
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;

        return $this;
    }

    /**
     * Get file_name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set document_root
     *
     * @param string $documentRoot
     * @return Vhost
     */
    public function setDocumentRoot($documentRoot)
    {
        $this->document_root = $documentRoot;

        return $this;
    }

    /**
     * Get document_root
     *
     * @return string
     */
    public function getDocumentRoot()
    {
        return $this->document_root;
    }

    /**
     * Set server_admin
     *
     * @param string $serverAdmin
     * @return Vhost
     */
    public function setServerAdmin($serverAdmin)
    {
        $this->server_admin = $serverAdmin;

        return $this;
    }

    /**
     * Get server_admin
     *
     * @return string
     */
    public function getServerAdmin()
    {
        return $this->server_admin;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Vhost
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
     * @return Vhost
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
     * Set server
     *
     * @param Bellcom\ServerInfoBundle\Entity\Server $server
     * @return Vhost
     */
    public function setServer(\Bellcom\ServerInfoBundle\Entity\Server $server = null)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return Bellcom\ServerInfoBundle\Entity\Server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return Vhost
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }
}

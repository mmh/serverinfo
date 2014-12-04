<?php
namespace Bellcom\ServerInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mails")
 */
class Mails
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Server", inversedBy="servers", cascade={"remove"})
     * @ORM\JoinColumn(name="server_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $server;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number_mails = 0;


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
     * Set date
     *
     * @param integer $date
     * @return Mails
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set server
     *
     * @param Bellcom\ServerInfoBundle\Entity\Server $server
     * @return Mails
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
     * Set number_mails
     *
     * @param integer $numberMails
     * @return Mails
     */
    public function setNumberMails($numberMails)
    {
        $this->number_mails = $numberMails;

        return $this;
    }

    /**
     * Get number_mails
     *
     * @return integer
     */
    public function getNumberMails()
    {
        return $this->number_mails;
    }
}

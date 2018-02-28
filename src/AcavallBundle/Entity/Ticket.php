<?php

namespace AcavallBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AcavallBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="PersonalDocument", type="string", length=255)
     */
    private $personalDocument;

    /**
      * @var string
      *
      * @ORM\Column(name="childage", type="string", length=255, nullable=true)
      */
    private $childage;

    /**
      * @var string
      *
      * @ORM\Column(name="gender", type="string", length=255)
      */
    private $gender;

    /**
     * @var int
     *
     * @ORM\Column(name="numTicket", type="integer")
     */
    private $numTicket;

  /**
    * @var boolean
    *
    * @ORM\Column(name="disability", type="boolean")
    */
   private $disability;

   /**
     * @var boolean
     *
     * @ORM\Column(name="support", type="boolean")
     */
    private $support;

    /**
     * @var string
     *
     * @ORM\Column(name="TransactionData", type="string", length=255)
     */
    private $transactionData;

    /**
     * @var string
     *
     * @ORM\Column(name="Price", type="decimal", precision=2, scale=0)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tickets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
   private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="tickets")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
   private $event;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Ticket
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set personalDocument
     *
     * @param string $personalDocument
     *
     * @return Ticket
     */
    public function setPersonalDocument($personalDocument)
    {
        $this->personalDocument = $personalDocument;

        return $this;
    }

    /**
     * Get personalDocument
     *
     * @return string
     */
    public function getPersonalDocument()
    {
        return $this->personalDocument;
    }

    /**
     * Set transactionData
     *
     * @param string $transactionData
     *
     * @return Ticket
     */
    public function setTransactionData($transactionData)
    {
        $this->transactionData = $transactionData;

        return $this;
    }

    /**
     * Get transactionData
     *
     * @return string
     */
    public function getTransactionData()
    {
        return $this->transactionData;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set user
     *
     * @param \AcavallBundle\Entity\User $user
     *
     * @return Ticket
     */
    public function setUser(\AcavallBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AcavallBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \AcavallBundle\Entity\Event $event
     *
     * @return Ticket
     */
    public function setEvent(\AcavallBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AcavallBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set childage
     *
     * @param string $childage
     *
     * @return Ticket
     */
    public function setChildage($childage)
    {
        $this->childage = $childage;

        return $this;
    }

    /**
     * Get childage
     *
     * @return string
     */
    public function getChildage()
    {
        return $this->childage;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Ticket
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set disability
     *
     * @param boolean $disability
     *
     * @return Ticket
     */
    public function setDisability($disability)
    {
        $this->disability = $disability;

        return $this;
    }

    /**
     * Get disability
     *
     * @return boolean
     */
    public function getDisability()
    {
        return $this->disability;
    }

    /**
     * Set support
     *
     * @param boolean $support
     *
     * @return Ticket
     */
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support
     *
     * @return boolean
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set numTicket
     *
     * @param integer $numTicket
     *
     * @return Ticket
     */
    public function setNumTicket($numTicket)
    {
        $this->numTicket = $numTicket;

        return $this;
    }

    /**
     * Get numTicket
     *
     * @return integer
     */
    public function getNumTicket()
    {
        return $this->numTicket;
    }
}

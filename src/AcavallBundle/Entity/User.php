<?php

namespace AcavallBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AcavallBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = array();

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=512)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="PersonalDocument", type="string", length=255, nullable=true)
     */
    private $personalDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var bool
     *
     * @ORM\Column(name="verifyPassword", type="boolean")
     */
    private $verifyPassword;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="verifyCode", type="string", length=255, nullable=true)
     */
    private $verifyCode;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="user")
     */
    private $tickets;

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
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
     public function setRoles(array $roles)
     {
         $this->roles = $roles;
         return $this;
     }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set personalDocument
     *
     * @param string $personalDocument
     *
     * @return User
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
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set verifyPassword
     *
     * @param boolean $verifyPassword
     *
     * @return User
     */
    public function setVerifyPassword($verifyPassword)
    {
        $this->verifyPassword = $verifyPassword;

        return $this;
    }

    /**
     * Get verifyPassword
     *
     * @return bool
     */
    public function getVerifyPassword()
    {
        return $this->verifyPassword;
    }

    /**
     * Set verifyCode
     *
     * @param string $verifyCode
     *
     * @return User
     */
    public function setVerifyCode($verifyCode)
    {
        $this->verifyCode = $verifyCode;

        return $this;
    }

    /**
     * Get verifyCode
     *
     * @return string
     */
    public function getVerifyCode()
    {
        return $this->verifyCode;
    }

    public function getPlainPassword()
   {
       return $this->plainPassword;
   }

   public function setPlainPassword($password)
   {
       $this->plainPassword = $password;
   }

   public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials(){}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \AcavallBundle\Entity\Ticket $ticket
     *
     * @return User
     */
    public function addTicket(\AcavallBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \AcavallBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\AcavallBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

}

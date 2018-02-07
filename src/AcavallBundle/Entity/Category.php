<?php

namespace AcavallBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AcavallBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    //RELACION  MANY-TO-MANY
   /**
   * @ORM\ManyToMany(targetEntity="Event", mappedBy="categories")
   */
   private $events;

   public function __construct() {
       $this->events = new \Doctrine\Common\Collections\ArrayCollection();
   }


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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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

    public function __toString(){
      return $this->name;
    }

    /**
     * Add event
     *
     * @param \AcavallBundle\Entity\Event $event
     *
     * @return Category
     */
    public function addEvent(\AcavallBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \AcavallBundle\Entity\Event $event
     */
    public function removeEvent(\AcavallBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}

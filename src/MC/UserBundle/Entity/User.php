<?php

namespace MC\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class User extends BaseUser
{
	/**
    * @ORM\ManyToMany(targetEntity="MC\EventBundle\Entity\Evenement", inversedBy="users")
    */

    private $evenements;

    /**
     * @ORM\ManyToMany(targetEntity="MC\EventBundle\Entity\CA", inversedBy="users")
     */

    private $cas;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Add evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     * @return User
     */
    public function addEvenement(\MC\EventBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;

        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\MC\EventBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Add cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     * @return User
     */
    public function addCa(\MC\EventBundle\Entity\CA $cas)
    {
        $this->cas[] = $cas;

        return $this;
    }

    /**
     * Remove cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     */
    public function removeCa(\MC\EventBundle\Entity\CA $cas)
    {
        $this->cas->removeElement($cas);
    }

    /**
     * Get cas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCas()
    {
        return $this->cas;
    }
}

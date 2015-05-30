<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Theme
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\ThemeRepository")
 */
class Theme
{

    /**
    * @ORM\ManyToMany(targetEntity="CA", inversedBy="theme")
    */
    
    private $cas;

   /**
   * @ORM\ManyToMany(targetEntity="Evenement", inversedBy="themes")
   */

   private $evenements;

public function __construct()
{
    $this->cas = new ArrayCollection();
    $this->evenenements = new ArrayCollection();
}

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="theme", type="array")
     */
    private $theme;


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
     * Set theme
     *
     * @param array $theme
     * @return Theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return array 
     */
    public function getTheme()
    {
        return $this->theme;
    }

  
    /**
     * Add cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     * @return Theme
     */
    public function addCa(\MC\EventBundle\Entity\CA $cas)
    {
        $this->cas[] = $cas;

        return $this;
    }

    /**
     * Remove ca
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

    /**
     * Add evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     * @return Theme
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
}

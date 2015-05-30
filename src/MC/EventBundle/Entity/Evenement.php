<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\ElasticaBundle\Configuration\Search;

/**
 * Evenement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\EvenementRepository")
 * @Search(repositoryClass="MC\EventBundle\Entity\EvenementRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Evenement
{
     /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist"})
     */
     private $image;

    /**
    * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="evenements")
    */ 
    
    private $utilisateurs;

    /**
    * @ORM\ManyToMany(targetEntity="CA", mappedBy="evenements")
    */

    private $cas;

    /**
    * @ORM\ManyToMany(targetEntity="MC\UserBundle\Entity\User", mappedBy="evenements")
    */

    private $users;

    /**
    * @ORM\ManyToMany(targetEntity="Theme", mappedBy="evenements", cascade={"persist"})
    */ 

     private $themes;

      /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     * @Assert\Length(min=2,  minMessage="Le nom de l'événement doit faire au moins {{ limit }} caractères.")
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="nomOrganisateur", type="string", length=255)
     */
    private $nomOrganisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     * @Assert\DateTime()
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     * @Assert\Datetime()
     */
    private $fin;


    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     */
    private $descriptif;


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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string 
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set nomOrganisateur
     *
     * @param string $nomOrganisateur
     * @return Evenement
     */
    public function setNomOrganisateur($nomOrganisateur)
    {
        $this->nomOrganisateur = $nomOrganisateur;

        return $this;
    }

    /**
     * Get nomOrganisateur
     *
     * @return string 
     */
    public function getNomOrganisateur()
    {
        return $this->nomOrganisateur;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     * @return Evenement
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Evenement
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return Evenement
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }


    /**
     * Set image
     *
     * @param \MCEventBundle\Entity\Image $image
     * @return Evenement
     */
    public function setImage(\MCEventBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MC\EventBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cas = new ArrayCollection();
        // Par défaut, la date de l'évènement est la date d'aujourd'hui
        $this->debut = new \Datetime();
    }

    /**
     * Add utilisateurs
     *
     * @param \MC\EventBundle\Entity\Utilisateur $utilisateurs
     * @return Evenement
     */
    public function addUtilisateur(\MC\EventBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs[] = $utilisateurs;

        return $this;
    }

    /**
     * Remove utilisateurs
     *
     * @param \MC\EventBundle\Entity\Utilisateur $utilisateurs
     */
    public function removeUtilisateur(\MC\EventBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs->removeElement($utilisateurs);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    /**
     * Add users
     *
     * @param \MC\UserBundle\Entity\User $users
     * @return Evenement
     */
    public function addUser(\MC\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \MC\UserBundle\Entity\User $users
     */
    public function removeUser(\MC\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     * @return Evenement
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
    public function getCa()
    {
        return $this->cas;
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
     * Add themes
     *
     * @param \MC\EventBundle\Entity\Theme $themes
     * @return Evenement
     */
    public function addTheme(\MC\EventBundle\Entity\Theme $themes)
    {
        $this->themes[] = $themes;

        return $this;
    }

    /**
     * Remove themes
     *
     * @param \MC\EventBundle\Entity\Theme $themes
     */
    public function removeTheme(\MC\EventBundle\Entity\Theme $themes)
    {
        $this->themes->removeElement($themes);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTheme()
    {
        return $this->themes;
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemes()
    {
        return $this->themes;
    }
}

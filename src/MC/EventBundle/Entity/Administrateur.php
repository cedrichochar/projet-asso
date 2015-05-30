<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collection\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Administrateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\AdministrateurRepository")
 */
class Administrateur
{
    
    /**
    * @ORM\ManyToMany(targetEntity="CA", mappedBy="administrateurs")
    */

    private $cas;

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
     * @ORM\Column(name="nomAdministrateur", type="string", length=255)
     * @Assert\Length(min=2, minMessage=" Le nom de l'administrateur doit faire au moins {{ limit}} caractères.")
     */
    private $nomAdministrateur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomAdministrateur", type="string", length=255)
     * @Assert\Length(min=2, minMessage=" Le prénom de l'administrateur doit faire au moins {{ limit}} caractères.")
     */
    private $prenomAdministrateur;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMailAdministrateur", type="string", length=255)
     * @Assert\Email()
     */
    private $adresseMailAdministrateur;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasseAdministrateur", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $motDePasseAdministrateur;


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
     * Set nomAdministrateur
     *
     * @param string $nomAdministrateur
     * @return Administrateur
     */
    public function setNomAdministrateur($nomAdministrateur)
    {
        $this->nomAdministrateur = $nomAdministrateur;

        return $this;
    }

    /**
     * Get nomAdministrateur
     *
     * @return string 
     */
    public function getNomAdministrateur()
    {
        return $this->nomAdministrateur;
    }

    /**
     * Set prenomAdministrateur
     *
     * @param string $prenomAdministrateur
     * @return Administrateur
     */
    public function setPrenomAdministrateur($prenomAdministrateur)
    {
        $this->prenomAdministrateur = $prenomAdministrateur;

        return $this;
    }

    /**
     * Get prenomAdministrateur
     *
     * @return string 
     */
    public function getPrenomAdministrateur()
    {
        return $this->prenomAdministrateur;
    }

    /**
     * Set adresseMailAdministrateur
     *
     * @param string $adresseMailAdministrateur
     * @return Administrateur
     */
    public function setAdresseMailAdministrateur($adresseMailAdministrateur)
    {
        $this->adresseMailAdministrateur = $adresseMailAdministrateur;

        return $this;
    }

    /**
     * Get adresseMailAdministrateur
     *
     * @return string 
     */
    public function getAdresseMailAdministrateur()
    {
        return $this->adresseMailAdministrateur;
    }

    /**
     * Set motDePasseAdministrateur
     *
     * @param string $motDePasseAdministrateur
     * @return Administrateur
     */
    public function setMotDePasseAdministrateur($motDePasseAdministrateur)
    {
        $this->motDePasseAdministrateur = $motDePasseAdministrateur;

        return $this;
    }

    /**
     * Get motDePasseAdministrateur
     *
     * @return string 
     */
    public function getMotDePasseAdministrateur()
    {
        return $this->motDePasseAdministrateur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     * @return Administrateur
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

<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as  Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\UtilisateurRepository")
 * @UniqueEntity(fields="adresseMail", message="Cette adresse est déjà utilisée par un utilisateur")
 */
class Utilisateur
{


    /**
    * @ORM\ManyToMany(targetEntity="Evenement", inversedBy="utilisateurs")
    */

    private $evenements;

   /**
   * @ORM\ManyToMany(targetEntity="CA", inversedBy="utilisateurs")
   */

  private $cas;

public function __construct()
{
  $this->evenements = new ArrayCollection();
  $this->cas = new ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(name="nomUtilisateur", type="string", length=255)
     * @Assert\Length(min=2, minMessage="Le nom de l'utilisateur doit faire au moins {{ limit }} caractères.")
     */
    private $nomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUtilisateur", type="string", length=255)
     * @Assert\Length(min=2, minMessage="Le prénom de l'utilisateur doit faire au moins {{ limit }} caractères.")
     */
     
    private $prenomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMail", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $adresseMail;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $motDePasse;

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
     * Set nomUtilisateur
     *
     * @param string $nomUtilisateur
     * @return Utilisateur
     */
    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    /**
     * Get nomUtilisateur
     *
     * @return string 
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Set prenomUtilisateur
     *
     * @param string $prenomUtilisateur
     * @return Utilisateur
     */
    public function setPrenomUtilisateur($prenomUtilisateur)
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    /**
     * Get prenomUtilisateur
     *
     * @return string 
     */
    public function getPrenomUtilisateur()
    {
        return $this->prenomUtilisateur;
    }

    /**
     * Set adresseMail
     *
     * @param string $adresseMail
     * @return Utilisateur
     */
    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    /**
     * Get adresseMail
     *
     * @return string 
     */
    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Utilisateur
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }
  
    /**
     * Add evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     * @return Utilisateur
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
     * @return Utilisateur
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

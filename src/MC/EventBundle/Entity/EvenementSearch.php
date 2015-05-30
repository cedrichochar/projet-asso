<?php

namespace MC\EventBundle\Entity;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\ElasticaBundle\Configuration\Search;

/**
 * EvenementSearch
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\EvenementSearchRepository")
 */
class EvenementSearch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFrom", type="datetime")
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTo", type="datetime")
     */
    private $dateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="nomOrganisateur", type="string", length=255)
     */
    private $nomOrganisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     */
    private $nomEvenement;


    public function __construct()
    {
        // initialise the dateFrom to "one month ago", and the dateTo to "today"
        $date = new \DateTime();
        $month = new \DateInterval('P1Y');
        $date->add($month);
        $date->setTime('23','59','59');

        $this->dateTo = $date;
        $this->dateFrom = new \DateTime();
        $this->dateFrom->setTime('00','00','00');
    }


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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return EvenementSearch
     */
    public function setDateFrom($dateFrom)
    {
        if($dateFrom != ""){
            $dateFrom->setTime('00','00','00');
            $this->dateFrom = $dateFrom;
        }

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return EvenementSearch
     */
    public function setDateTo($dateTo)
    {
        if($dateTo != ""){
            $dateTo->setTime('23','59','59');
            $this->dateTo = $dateTo;
        }

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function clearDates(){
        $this->dateTo = null;
        $this->dateFrom = null;
    }

    /**
     * Set nomOrganisateur
     *
     * @param string $nomOrganisateur
     * @return EvenementSearch
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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     * @return EvenementSearch
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
}

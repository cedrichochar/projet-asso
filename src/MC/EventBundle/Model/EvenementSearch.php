<?php

namespace MC\EventBundle\Entity;

use Symfony\Component\HttpFoundation\Request;

class EvenementSearch
{
    // begin of publication range
    protected $dateFrom;

    // end of publication range
    protected $dateTo;

    // published or not
    protected $isPublished;

    protected $nomOrganisateur;

    protected $nomEvenement;

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

    public function setDateFrom($dateFrom)
    {
        if($dateFrom != ""){
            $dateFrom->setTime('00','00','00');
            $this->dateFrom = $dateFrom;
        }

        return $this;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function setDateTo($dateTo)
    {
        if($dateTo != ""){
            $dateTo->setTime('23','59','59');
            $this->dateTo = $dateTo;
        }

        return $this;
    }

    public function clearDates(){
        $this->dateTo = null;
        $this->dateFrom = null;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function getNomOrganisateur()
    {
        return $this->nomOrganisateur;
    }

    public function setNomOrganisateur($nomOrganisateur)
    {
        $this->nomOrganisateur = $nomOrganisateur;

        return $this;
    }

    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

}
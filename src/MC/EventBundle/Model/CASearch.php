<?php

namespace MC\EventBundle\Model;

use Symfony\Component\HttpFoundation\Request;

class CASearch
{
    protected $nomCA;

    
    public function getNomCA()
    {
        return $this->nomCA;
    }

    public function setNomCA($nomEvenement)
    {
        $this->nomCA = $nomCA;

        return $this;
    }

}
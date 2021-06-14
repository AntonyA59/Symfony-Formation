<?php

namespace App\Taxes;
/**
 * Permet de detecter si le prix est imposable ou non
 */
class Detector 
{
    protected $seuil;
    public function __construct($seuil)
    {
        $this->seuil = $seuil;
    }
    public function detect(float $prix) : bool
    {
        if($prix > $this->seuil){
            return true;
        }else{
            return false;
        }
    }
}
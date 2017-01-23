<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Personnage
 *
 * @author Quentin
 */
class Personnage {

    private $vie;
    private $experience;
    private $nom;

    function __construct($vie, $experience, $nom) {
        $this->vie = $vie;
        $this->experience = $experience;
        $this->nom = $nom;
    }

    function enVie() {
        return $this->vie > 0;
    }

    function soigne($pv) {
        if ($this->vie + $pv >= 100)
            $this->vie = 100;
        else
            $this->vie += $pv;
    }

    function getExperience() {
        return $this->experience;
    }

    function getNom() {
        return $this->nom;
    }

    function getVie() {
        return $this->vie;
    }

    function setVie($vie) {
        if ($vie >= 100)
            $this->vie = 100;
        else
            $this->vie = $vie;
    }

    function setExperience($experience) {
        $this->experience = $experience;
    }

    function gagneExperience($experience) {
        $this->experience += $experience;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

}

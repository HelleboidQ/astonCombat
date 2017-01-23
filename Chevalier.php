<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chevalier
 *
 * @author Quentin
 */
class Chevalier extends Personnage {

    function __construct($nom) {
        parent::__construct(100, 0, $nom);
    }

    function attaque() {
        if (rand(1, 40) == 40) {
            $degats += rand(4, 12) * 2;
        } else {
            $degats += rand(4, 12);
        }
        return $degats;
    }

    function defense() {
        return rand(6, 12);
    }

}

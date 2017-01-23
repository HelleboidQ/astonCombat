<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Archer
 *
 * @author Quentin
 */
class Archer extends Personnage {

    function __construct($nom) {
        parent::__construct(40, 100, 0, $nom);
    }

    function attaque() {
        $degats = 0;
        for ($i = 0; $i < 3; $i++) {
            if (rand(1, 50) == 1) {
                $degats += rand(2, 5) * 2;
            } else {
                $degats += rand(2, 5);
            }
        }
        return $degats;
    }

    function defense() {
        return rand(5, 10);
    }

}

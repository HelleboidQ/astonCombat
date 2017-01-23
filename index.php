<?php
require("Personnage.php");
require("Archer.php");
require("Chevalier.php");


$archer = new Archer("Legolas");
$chevalier = new Chevalier("Aragorn");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Combat</title>

    </head>
    <body>

        <?php
        while ($archer->enVie() || $chevalier->enVie()) {
            $degats = $archer->attaque();
            $chevalier->setVie($chevalier->getVie() - $degats);


            $degats = $chevalier->attaque();
            $archer->setVie($archer->getVie() - $degats);
        }
        ?>
        <?= ($archer->enVie() ? $archer->getNom() . $archer->gagneExperience(10) : $chevalier->getNom() . $chevalier->gagneExperience(10)) ?> a gagn� le combat !

    </body>
</html>




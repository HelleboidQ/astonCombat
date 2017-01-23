<?php
include("Personnage.php");
include("Archer.php");
include("Chevalier.php");


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
        /* while ($archer->enVie() || $chevalier->enVie()) {

          } */
        ?>
        <?= ($archer->enVie() ? $archer->getNom() : $chevalier->getNom()) ?> a gagné le combat !

    </body>
</html>




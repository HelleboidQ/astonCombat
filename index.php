<?php
require("Personnage.php");
require("Archer.php");
require("Chevalier.php");

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Combat</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            $jouer = 0;

            if (isset($_POST['joueur'])) {
                $jouer = 1;
                if (isset($_POST['type'])) {
                    if ($_POST['type'] == 0) {
                        $j1 = new Archer($_POST['pseudo']);
                    } else {
                        $j1 = new Chevalier($_POST['pseudo']);
                    }
                }

                if (isset($_POST['type2'])) {
                    if ($_POST['type2'] == 0) {
                        $j2 = new Archer($_POST['pseudo2']);
                    } else {
                        $j2 = new Chevalier($_POST['pseudo2']);
                    }
                }
                $tour = 0;
                $_SESSION['tour'] = 0;
                $_SESSION['j1'] = $j1;
                $_SESSION['j2'] = $j2;
            } else if (isset($_POST['joue'])) {
                $jouer = 1;
                $j1 = $_SESSION['j1'];
                $j2 = $_SESSION['j2'];

                if (isset($_POST['type']) && isset($_POST['type2'])) {
                    if ($_POST['type'] == 0) {
                        if ($_POST['type2'] == 0) {
                            //ATQ vs ATQ
                            $degats = $j1->attaque();
                            $j2->setVie($j2->getVie() - $degats);
                            if ($j2->enVie()) {
                                ?>
                                <div class="alert alert-danger">
                                    Bim -<?= $degats ?>
                                </div>
                                <?php
                            }
                            $degats = $j2->attaque();
                            $j1->setVie($j1->getVie() - $degats);
                            if ($j1->enVie()) {
                                ?>
                                <div class="alert alert-danger">
                                    Bim -<?= $degats ?>
                                </div>
                                <?php
                            }
                        } else if ($_POST['type2'] == 1) {
                            //ATQ vs DEF
                            $degats = $j1->attaque();
                            $defense = $j2->defense();
                            if ($degats > $defense) {
                                $j2->setVie($j2->getVie() - ($degats - $defense));
                                if ($j2->enVie()) {
                                    ?>
                                    <div class="alert alert-danger">
                                        Bim -<?= ($degats - $defense ) ?>
                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            //ATQ vs Potion
                            $j2->soigne(10);

                            $degats = $j1->attaque();
                            $j2->setVie($j2->getVie() - $degats);
                        }
                    } else if ($_POST['type'] == 1) {
                        if ($_POST['type2'] == 0) {
                            //DEF vs ATQ
                            $degats = $j2->attaque();
                            $defense = $j1->defense();
                            if ($degats > $defense) {
                                $j1->setVie($j1->getVie() - ($degats - $defense));
                                if ($j1->enVie()) {
                                    //  echo "Vie de " . $j1->getPseudo() . " : " . $j1->getVie() . "<br />";
                                    ?>
                                    <div class="alert alert-danger">
                                        Bim -<?= ($degats - $defense) ?>
                                    </div>
                                    <?php
                                }
                            }
                        } else if ($_POST['type2'] == 1) {
                            //DEF vs DEF
                        } else {
                            //DEF vs Potion
                            $j2->soigne(10);
                        }
                    } else {
                        if ($_POST['type2'] == 0) {
                            //Potion vs ATQ
                            $j1->soigne(10);
                            $degats = $j2->attaque();
                            $defense = $j1->defense();
                            if ($degats > $defense) {
                                $j1->setVie($j1->getVie() - $degats);
                            }
                        } else if ($_POST['type2'] == 1) {
                            //Potion vs DEF
                            $j1->soigne(10);
                        } else {
                            //Potion vs Potion
                            $j1->soigne(10);
                            $j2->soigne(10);
                        }
                    }
                }
                $_SESSION['tour'] ++;

                $_SESSION['j1'] = $j1;
                $_SESSION['j2'] = $j2;
            }
            if ($jouer == 0) {
                ?>


                <form method="post" role="form" action="index.php" >

                    <h1>Joueur 1</h1>
                    <div class="form-group">
                        <label for="pseudo">Pseudo </label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type </label>
                        <select name="type" required>
                            <option value="0">Archer</option>
                            <option value="1">Chevalier</option>
                        </select>
                    </div>

                    <h1>Joueur 2</h1>
                    <div class="form-group">
                        <label for="pseudo2">Pseudo </label>
                        <input type="text" class="form-control" id="pseudo2" name="pseudo2" required>
                    </div>
                    <div class="form-group">
                        <label for="type2">Type </label>
                        <select name="type2" required>
                            <option value="0">Archer</option>
                            <option value="1">Chevalier</option>
                        </select>
                    </div>

                    <button type="submit" name="joueur" class="btn btn-default">Valider</button>
                </form>
                <?php
            } else {
                $j1 = $_SESSION['j1'];
                $j2 = $_SESSION['j2'];

                /* echo "<pre>";
                  print_r($_SESSION);
                  echo "</pre>"; */
                ?>

                <form method="post" role="form" action="index.php" >

                    <h1>Joueur 1 : <?= $j1->getNom() ?></h1>

                    <div class="progress">
                        <div class="progress-bar progress-bar<?= $j1->getVie() > 50 ? "-success" : ($j1->getVie() > 30 ? "-warning" : "-danger") ?>" role="progressbar" aria-valuenow="70"
                             aria-valuemin="0" aria-valuemax="100" style="width:<?= $j1->getVie() ?>%">
                            Vie : <?= $j1->getVie() ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type">Type </label>
                        <select name="type" required>
                            <option value="0">Attaque</option>
                            <option value="1">Defense</option>
                            <?php
                            if ($_SESSION['tour'] % 5 == 0 && $_SESSION['tour'] != 0) {
                                ?>
                                <option value="2">Potion +10PV</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <h1>Joueur 2 : <?= $j2->getNom() ?></h1>

                    <div class="progress">
                        <div class="progress-bar progress-bar<?= $j2->getVie() > 50 ? "-success" : ($j2->getVie() > 30 ? "-warning" : "-danger") ?>" role="progressbar" aria-valuenow="70"
                             aria-valuemin="0" aria-valuemax="100" style="width:<?= $j2->getVie() ?>%">
                            Vie : <?= $j2->getVie() ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type2">Type </label>
                        <select name="type2" required>
                            <option value="0">Attaque</option>
                            <option value="1">Defense</option>
                            <?php
                            if ($_SESSION['tour'] % 5 == 0 && $_SESSION['tour'] != 0) {
                                ?>
                                <option value="2">Potion +10PV</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    if ($j1->enVie() && $j2->enVie()) {
                        ?>
                        <button type="submit" name="joue" class="btn btn-default">Valider</button>
                        <?php
                    } else {
                        ?>
                        <span class="label label-success" style="font-size: 18px;">GG</span>
                        <br /><br />
                        <a href="index.php" class="btn btn-default">Rejouer</a>
                        <?php
                    }
                    ?>
                </form>
                <?php
            }
            ?>
        </div>
    </body>
</html>




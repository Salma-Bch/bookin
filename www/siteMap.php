<!DOCTYPE html>
<html lang="fr">
    <?php
    /**
     * @File        siteMap.php
     * @package     www
     * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * @Version     1.0
     * @Date        05/04/2021
     * @Brief       Plan de l'application web Book'In.
     * @Details     Permet l'affichage des liens menant vers chaques pages de l'application web.
     */

    ?>
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Plan du site</title>
    </head>
    <body>
        <?php
            include("include/header.php");
        ?>
        <div class="head_location"></div>
        <div class="container bodyContainer termsOfUses" id="termsOfUse">
            <h2>Plan du site</h2>
            <div class="row conditions">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <a href="index.php"><p class="condition">Accueil</p></a>
                        <a href="searchSpace.php"><p class="condition">Nos livres</p></a>
                    </div>
                    <div class="col-sm-4">
                        <a href="clientLoginSpace.php"><p class="condition">Espace client</p></a>
                        <a href="administratorLoginSpace.php"><p class="condition">Espace administrateur</p></a>
                    </div>
                    <div class="col-sm-4">
                        <a href="informationSpace.php"><p class="condition">À propos</p></a>
                        <a href="termsOfUse.php"><p class="condition">Condition d'utilisation</p></a>
                    </div>
                </div>
            </div>
        </div>
		<?php
			include("include/footer.php");
		?>
	</body>
</html>

<!DOCTYPE html>
<html lang="fr">
    <?php
        /**
         * \file      siteMap.php
         * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
         * \version   1.0
         * \date      1 janvier 2021
         * \brief     Plan de l'application web Book'In.
         * \details   Lien menant vers chaques pages de l'application web.
         */
    ?>
    <head>
        <?php
            include_once("ressources/include/head.php");
        ?>
        <title>Plan du site</title>
    </head>
    <body>
        <?php
            include("ressources/include/header.php");
        ?>
        <div class="head_location"></div>
        <div class="container">
            <h1>Plan du site</h1>
            <div class="row plan">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <a href="../../../../../wamp64/www/boooooooook/index.php"><p>Accueil</p></a>
                        <a href="searchSpace.php"><p>Nos livres</p></a>
                    </div>
                    <div class="col-sm-4">
                        <a href="../../../../../wamp64/www/boooooooook/clientLoginSpace.php"><p>Espace client</p></a>
                        <a href="../../../../../wamp64/www/boooooooook/administratorLoginSpace.php"><p>Espace administrateur</p></a>
                    </div>
                    <div class="col-sm-4">
                        <a href="informationSpace.php"><p>À propos</p></a>
                        <a href="termsOfUse.php"><p>Condition d'utilisation</p></a>
                    </div>
                </div>
            </div>
		</div>
		<?php
			include("ressources/include/footer.php");
		?>
	</body>
</html>

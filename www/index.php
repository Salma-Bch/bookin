<?php
session_start();
use controller\Suggestion;

include_once("include/includeFiles.php");

?>
<!DOCTYPE html>
<html lang="fr">
    <?php
        /**
         * \file      index.php
         * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
         * \version   1.0
         * \date      1 janvier 2021
         * \brief     Page d'accueil de l'application web Book'In.
         * \details   Présentation des livres à la une + un espace de connexion ou un espace de création de compte.
         */
    ?>
	<head>
        <?php
        include_once("include/head.php");
        ?>
		<title>Book'In</title>
	</head>
	<body>
        <?php
            include("include/header.php");
        ?>
		<div class="head_index">
			<div class="container">
				<h1 class="titrePrincipal">Book'In</h1>
				<p class="sous-titre">Librairie en ligne</p>
			</div>
        </div>

        <div class="container">
            <div class="col-md-12">
                <?php
                    if(isset($_SESSION['bookinClient']))
                        include_once ("./include/displayedBook.php");
                    else
                        include_once ("./include/displayBooksTendance.php");
                ?>
                <div class="col-md-12">
                    <h2>Connectez-vous !</h2>
                    <button class="btn modifEtDeco" onclick="location.href='./clientLoginSpace.php'">Connectez vous</button>
                </div>;
            </div>

        </div>
        <?php
            include("include/footer.php");
        ?>
	</body>
</html>
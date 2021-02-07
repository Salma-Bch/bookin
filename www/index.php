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
        include_once("ressources/include/head.php");
        ?>
		<title>Book'In</title>
	</head>
	<body>
        <?php
            include("ressources/include/header.php");
        ?>
		<div class="head_index">
			<div class="container">
				<h1 class="titrePrincipal">Book'In</h1>
				<p class="sous-titre">Librairie en ligne</p>
			</div>
		</div>
        <?php
            include("ressources/include/footer.php");
        ?>
	</body>
</html>
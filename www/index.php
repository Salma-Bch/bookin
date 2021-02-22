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
        <div class="container"
            <div class="col-md-12 suggestions">
                <p>Connectez-vous pour une suggestion de livre adaptez à vos envies.</p>
                <button class='btn btn-xs btn-warning btn-block' name="submit"  onclick='document.location.href="clientLoginSpace";' >Se connecter</button>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>
	</body>
</html>
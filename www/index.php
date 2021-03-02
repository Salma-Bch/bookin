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
                <h2>Sélectionnés pour vous !</h2>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner partie_suggestions">
                        <div class="carousel-item active">
                            <img src="ressources/bd/bookImages/actualite/actualite_1.png"  alt="...">
                            <img src="ressources/bd/bookImages/actualite/actualite_2.png"  alt="...">
                            <img src="ressources/bd/bookImages/actualite/actualite_3.png" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="ressources/bd/bookImages/vie_pratique/vie_pratique_1.png"  alt="...">
                            <img src="ressources/bd/bookImages/vie_pratique/vie_pratique_2.png"  alt="...">
                            <img src="ressources/bd/bookImages/vie_pratique/vie_pratique_3.png" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="ressources/bd/bookImages/amour/amour_1.png"  alt="...">
                            <img src="ressources/bd/bookImages/amour/amour_3.png"  alt="...">
                            <img src="ressources/bd/bookImages/amour/amour_8.png" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="ressources/bd/bookImages/loisir/loisir_4.png"  alt="...">
                            <img src="ressources/bd/bookImages/loisir/loisir_5.png"  alt="...">
                            <img src="ressources/bd/bookImages/loisir/loisir_7.png" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <h2>Connectez-vous !</h2>
                <p>Connectez-vous pour une suggestion de livre adaptez à vos envies.</p>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>
	</body>
</html>
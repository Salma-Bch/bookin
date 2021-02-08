<?php
    /**
     * \file      espaceLocation.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * \version   1.0
     * \date      1 janvier 2021
     * \brief     Affiche l'espace de recherche de livre.
     * \details   Grille présentant les différents livres proposés par le site.
     */
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
        <?php
            include_once("ressources/include/head.php");
        ?>
		<title>Espace de recherche</title>
	</head>
	<body>
        <?php
            include_once("ressources/include/header.php");
        ?>
		<div class="head_location"></div>
		<div class="container">
	        <h1>Espaces de recherche</h1>
            <div class="d-flex justify-content-start">
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégorie</button>
                    <ul class="dropdown-menu" id="color">
                        <li><div class="dropdown-item" data-value="Rouge"><input type="checkbox"/>&#160;Actualité</div></li>
                        <li><div class="dropdown-item" data-value="Blanche"><input type="checkbox"/>&#160;Amour</div></li>
                        <li><div class="dropdown-item" data-value="Noire"><input type="checkbox"/>&#160;Art</div></li>
                        <li><div class="dropdown-item" data-value="Orange"><input type="checkbox"/>&#160;Bande dessinée</div></li>
                        <li><div class="dropdown-item" data-value="Jaune"><input type="checkbox"/>&#160;Bien-être</div></li>
                        <li><div class="dropdown-item" data-value="Verte"><input type="checkbox"/>&#160;Cuisine</div></li>
                        <li><div class="dropdown-item" data-value="Grise"><input type="checkbox"/>&#160;Culture</div></li>
                        <li><div class="dropdown-item" data-value="Rouge"><input type="checkbox"/>&#160;Education</div></li>
                        <li><div class="dropdown-item" data-value="Noire"><input type="checkbox"/>&#160;Histoire</div></li>
                        <li><div class="dropdown-item" data-value="Jaune"><input type="checkbox"/>&#160;Loisir</div></li>
                        <li><div class="dropdown-item" data-value="Grise"><input type="checkbox"/>&#160;Policier</div></li>
                        <li><div class="dropdown-item" data-value="Rouge"><input type="checkbox"/>&#160;Psychologie</div></li>
                        <li><div class="dropdown-item" data-value="Blanche"><input type="checkbox"/>&#160;Santé</div></li>
                        <li><div class="dropdown-item" data-value="Noire"><input type="checkbox"/>&#160;Science</div></li>
                        <li><div class="dropdown-item" data-value="Orange"><input type="checkbox"/>&#160;Science-fiction</div></li>
                        <li><div class="dropdown-item" data-value="Verte"><input type="checkbox"/>&#160;Vie pratique</div></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Auteur</button>
                    <ul class="dropdown-menu" id="color">
                        <li><div class="dropdown-item" data-value="Rouge"><input type="checkbox"/>&#160;Victor Hugo</div></li>
                        <li><div class="dropdown-item" data-value="Blanche"><input type="checkbox"/>&#160;Emile Zola</div></li>
                        <li><div class="dropdown-item" data-value="Noire"><input type="checkbox"/>&#160;Charles Baudelaire</div></li>
                        <li><div class="dropdown-item" data-value="Orange"><input type="checkbox"/>&#160;George Sand</div></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tranche d'âge</button>
                    <ul class="dropdown-menu" id="color">
                        <li><div class="dropdown-item" data-value="Rouge"><input type="checkbox"/>&#160;-10 ans</div></li>
                        <li><div class="dropdown-item" data-value="Noire"><input type="checkbox"/>&#160;Entre 10 ans et 17 ans</div></li>
                        <li><div class="dropdown-item" data-value="Orange"><input type="checkbox"/>&#160;+18 ans</div></li>
                        <li><div class="dropdown-item" data-value="Jaune"><input type="checkbox"/>&#160;+65 ans</div></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Prix</button>
                    <ul class="dropdown-menu" id="place">
                        <li><div class="dropdown-item" data-value="2"><input type="checkbox"/>&#160;Moins de 10€</div></li>
                        <li><div class="dropdown-item" data-value="4"><input type="checkbox"/>&#160;Entre 10€ et 20€</div></li>
                        <li><div class="dropdown-item" data-value="5"><input type="checkbox"/>&#160;Entre 20€ et 40€</div></li>
                        <li><div class="dropdown-item" data-value="7"><input type="checkbox"/>&#160;Plus de 40€</div></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
			include("ressources/include/footer.php");
		?>
	</body>
</html>
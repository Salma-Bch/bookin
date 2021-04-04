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
        <link rel="stylesheet" href="ressources/css/styleRange.css"/>
        <?php
            include_once("include/head.php");
            include ("./include/includeFiles.php");
            //include("./class/utility/Math.php")
        ?>
		<title>Espace de recherche</title>
	</head>
	<body>
        <?php
            include_once("include/header.php");
        ?>
		<div class="head_location"></div>
		<div class="container">
	        <h1>Espace de recherche</h1>
            <div class="col-md-12">
                <div class="row">
                    <?php include("./include/searchFilters.php");?>
                    <?php include ("./include/displayAllBooks.php");?>
                </div>
            </div>
        </div>
        <?php
			include("include/footer.php");
		?>
	</body>
</html>
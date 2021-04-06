<?php
/**
 * @File        searchSpace.php
 * @package     www
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        05/04/2021
 * @Brief       Espace de recherche de livre de l'application web Book'In.
 * @Details     Permet l'affichage de tout les livres.
 *              Le client a la possibilité de filtrer ses recherches à l'aide de filtres : Catégorie - Tranche d'âge - Prix.
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
		<div class="container bodyContainer">
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
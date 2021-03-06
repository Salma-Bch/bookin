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
            include_once("include/head.php");
            include("./class/utility/Math.php")
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
                    <?php //include("./include/displayedBook.php");?>
                </div>
                <?php
                    $numbers = \utility\Math::nearestFigure(8,array(9,11,5,7,5,19,-3),3);
                    var_dump($numbers);
                ?>
            </div>
        </div>
        <?php
			include("include/footer.php");
		?>
	</body>
</html>
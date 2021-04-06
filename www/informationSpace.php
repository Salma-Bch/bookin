<!DOCTYPE html>
<html lang="fr">
<?php
      /**
       * @File        informationSpace.php
       * @package     www
       * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
       * @Version     1.0
       * @Date        05/04/2021
       * @Brief       Espace d'information de l'application web Book'In.
       * @Details     Permet l'affichage des informations des créateurs de l'applications web Book'In.
       */
    ?>
	<head>
        <?php
        include_once("include/head.php");
        ?>
		<title>A propos</title>
	</head>
	<body>
		<?php
	    	include("include/header.php");
	  	?>
        <div class="head_location"></div>
        <div class="container bodyContainer" id="aPropos">
            <h2>À propos</h2>
            <div class="row">
                <div class="col-md-12 propos">
                    <p>
                        Passionnés par la lecture, les étudiants Salma BENCHELKHA, Mouncif LEKMITI et Farah MANOUBI
                        ont conçu cette application web afin de proposer à tous les grands amateurs de lecture une large
                        sélection de livre de toutes catégories. Fondé en 2021, ce concept a pour but de faciliter à tous
                        l'accès aux livres sans sortir de chez vous.
                    </p>
                    <p class="citationPropos">
                        "Tourner les pages d'un livre ne vous brûlera pas les doigts mais peut vous réchauffer le coeur."
                        Rien de tel qu'un livre pour vous permettre de vous évader dans d'autres contrées, en restant
                        confortablement assis ou allongé sur votre canapé.
                    </p>
                    <p>
                        Envie d'un livre à l'histoire palpitante, ou d'un roman vous donnant froid dans le dos, avec notre
                        large sélection vous serez satisfait qu'importe vos envies. Notre ojectif est de fournir à nos clients
                        une expérience agréable, du premier clic de la souris jusqu’à la livraison de vos livres.
                        En achetant chez nous, vous optez pour un service avenant et fiable.
                    </p>
                </div>
            </div>
        </div>
		<?php
			include("include/footer.php");
		?>
	</body>
</html>
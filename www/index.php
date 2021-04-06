<?php
include_once("include/includeFiles.php");
session_start();
use controller\Suggestion;

?>
<!DOCTYPE html>
<html lang="fr">
    <?php
    /**
     * @File        index.php
     * @package     www
     * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * @Version     1.0
     * @Date        05/04/2021
     * @Brief       Page d'accueil de l'application web Book'In.
     * @Details     Permet l'affichage de la page d'accueil de l'application web Book'In.
     *              Le client non-connecté a accès aux tendances actuelles.
     *              Le client connecté a accès aux suggestions personnelles effectées avec les algorithmes.
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

        <div class="container bodyContainer">
            <div id="suggestion" class="col-md-12">
                <div class="loader">
                    <h2>suggestion en cours de chargement..</h2>
                </div>
                <script>
                    $( document ).ready(function() {
                        var url = "./include/displayBooksTendance.php";
                        if(<?php echo isset($_SESSION['bookinClient'])?'true':'false'; ?>) {
                            url = './include/displayedBook.php';
                            document.getElementById("connecter").style = "display:none";
                        }

                        $.ajax({
                            type: 'post',
                            url: url,
                            success: function (response) {
                                if (response.includes("failed")) {
                                    $("#suggestion").html("<h2 id='loadMsg''>Impossible de charger la suggestion</p>");
                                } else {
                                    $("#suggestion").html(response);
                                    $("#connecter").style("display:block");
                                }
                            },
                            error: function () {
                                $("#suggestion").html("<h2 id='loadMsg' >Impossible de charger la suggestion</h2>");
                            }
                        });
                    });

                </script>
            </div>
            <div class="col-md-12" id="connecter" style="display: block">
                <h2>Connectez-vous !</h2>
                <button class="btn modifEtDeco" onclick="location.href='./clientLoginSpace.php'">Connectez vous</button>
            </div>

        </div>
        <?php
            include("include/footer.php");
        ?>
	</body>
</html>
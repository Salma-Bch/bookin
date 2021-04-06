<!DOCTYPE html>
<html lang="fr">
    <?php
    /**
     * @File        clientAccountCreationSpace.php
     * @package     www
     * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * @Version     1.0
     * @Date        05/04/2021
     * @Brief       Création d'un compte client.
     * @Details     Permet l'affichage d'un formulaire de création de compte client.
     */

    ?>
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Création de compte</title>
    </head>
    <body>
        <?php
            include("include/header.php");
        ?>
        <div class ='container-connexion'>
            <div class='card card-container-mdp'>
                <h2 class="mb-5 mt-5" style="margin-left: 0;">Création d'un compte client Book'In</h2>
                <form id ="compteInfo" class="form-group" method="post" onsubmit="return false">
                    <div id="firstPart">
                        <?php
                            include("./include/firstAccountCreationPart.php");
                        ?>
                    </div>
                    <div id="secondPart" style="display: none">
                        <?php
                            include("./include/secondAccountCreationPart.php");
                        ?>
                    </div>
                    <div id="thirdPart" style="display: none">
                        <?php
                            include("./include/thirdAccountCreationPart.php");
                        ?>
                    </div>
                    <div id="fourthPart" style="display: none">
                        <?php
                            include("./include/fourthAccountCreationPart.php");
                        ?>
                    </div>
                </form>
            </div>
        </div>
        <?php
            include("include/footer.php");
            include("include/dialogModal.php");
        ?>
    </body>
</html>
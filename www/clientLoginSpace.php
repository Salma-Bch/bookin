<?php
    /**
     * \file      espaceConnexion.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace de connexion de l'utilisateur.
     * \details   Formulaire de connexion avec une adresse mail et un mot de passe à renseignés.
*/
    session_start();
    if(isset($_SESSION['bookinClient'])){
        header('Location: ./clientSpace.php');
        exit(0);
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Espace de connexion</title>
    </head>
    <body>
        <?php
            include_once("include/header.php");
        ?>
        <div class='container-connexion'>
            <div class='card card-container'>
                <img id='profile-img' class='profile-img-card' src='ressources/images/avatar.png' alt="Avatar de connexion"/>
                <div class="alert alert-danger" role="alert" style="display: none" id="idOrMdpFalseDiv">
                    <span class="sr-only">Error:</span>
                    Identifiant ou mot de passe incorrect.
                </div>
                <form class='form-signin' id="connectionInfosForm" onsubmit="return false">
                    <input type='email' id='inputEmail' name='email' class='form-control' placeholder='mail@exemple.fr' required="" autofocus="" />
                    <input type='password' id='inputPassword' name='password' class='form-control' placeholder='Mot de passe' required="" />
                    <button class='btn btn-lg btn-danger btn-block btn-signin' id="loginButton" onclick="sendData()" type='submit'>Se connecter</button>
                </form>
                <p><a href='clientAccountCreationSpace.php' class='forgot-password'>Vous n'avez pas de compte ?</a></p>
            </div>
        </div>
        <?php
        include("include/footer.php");
        ?>
        <script>
            function sendData() {
                var formData = $("#connectionInfosForm").serialize();
                $.ajax({
                    type: 'post',
                    url: './include/checkIdentifiers',
                    data: formData,
                    success: function (response) {
                        if(response === "authentication successful")
                            window.location.assign("clientSpace.php");
                        else {
                            document.getElementById("idOrMdpFalseDiv").style.display = "block";
                        }
                    }
                });

                return false;
            }
        </script>
    </body>
</html>
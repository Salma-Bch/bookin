<?php
/**
 * @File        administratorLoginSpace.php
 * @package     www
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        05/04/2021
 * @Brief       Espace de connexion de l'administrateur.
 * @Details     Permet l'affichage d'un formulaire de connexion avec une adresse mail et un mot de passe à renseignés.
 */

session_start();
if(isset($_SESSION['bookinAdministrator'])){
    header('Location: ./administratorSpace.php');
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
        <h2 class="adminLogin">Espace de connexion</h2>
        <h3 class="adminLogin">Administrateur</h3>
        <img id='profile-img' class='profile-img-card' src='ressources/images/avatar.png' alt="Avatar de connexion"/>
        <div class="alert alert-danger" role="alert" style="display: none" id="idOrMdpFalseDiv">
            <span class="sr-only">Error:</span>
            Identifiant ou mot de passe incorrect.
        </div>
        <form class='form-signin' id="connectionAdministratorInfosForm" onsubmit="return false">
            <input type='email' id='inputEmail' name='email' class='form-control' placeholder='mail@exemple.fr' required="" autofocus="" />
            <input type='password' id='inputPassword' name='password' class='form-control' placeholder='Mot de passe' required="" />
            <button class='btn btn-lg btn-danger btn-block btn-signin' id="loginButton" onclick="sendAdministratorData()" type='submit'>Se connecter</button>
        </form>
    </div>
</div>
<?php
include("include/footer.php");
?>
<script>
    function sendAdministratorData() {
        var formData = $("#connectionAdministratorInfosForm").serialize();
        $.ajax({
            type: 'post',
            url: './include/checkAdministratorIdentifiers',
            data: formData,
            success: function (response) {
                if(response === "authentication successful")
                    window.location.assign("administratorSpace.php");
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
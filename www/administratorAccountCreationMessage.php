<!DOCTYPE html>
<html lang="fr">
<?php
/**
 * @File        administratorAccountCreationMessage.php
 * @package     www
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        05/04/2021
 * @Brief       Affichage d'un message concernant la création d'un compte administrateur.
 * @Details     Permet l'affichage d'un message indiquant à l'utilisateur de se connecter afin de créer un nouveau compte administrateur.
 */

session_start();

if(isset($_SESSION['bookinAdministrator'])){
    header('Location: ./administratorAccountCreationSpace.php');
    exit(0);
}
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
    <div class='card card-container-mdp adminCreat'>
        <h2 class="mb-5 mt-5" style="margin-left: 0;">Vous devez être un administrateur afin de pouvoir créer un nouveau compte administrateur Book'In.</h2>
        <button class="btn modifEtDeco" onclick="location.href='./AdministratorLoginSpace.php'">Connectez-vous !</button>
    </div>
</div>

<?php
include("include/footer.php");
include("include/dialogModal.php");
?>
</body>
</html>
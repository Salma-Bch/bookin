<!DOCTYPE html>
<html lang="fr">
<?php
/**
 * \file      creationCompte.php
 * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
 * \version   1.0
 * \date      8 janvier 2020
 * \brief     Affiche la page de création de compte.
 * \details   Formulaire à remplir par l'utilisateur afin d'obtenir un espace personnel.
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
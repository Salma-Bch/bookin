<?php
    /**
     * \file      clientSpace.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace personnel de l'utilisateur.
     * \details   Mes informations personnelles
     */

    use dao\DAOFactory;
    use utility\Format;

    include_once('./class/model/Administrator.php');
    include_once("./include/includeFiles.php");

    session_start();

    if(!isset($_SESSION['bookinAdministrator'])){
        header('Location: ./administratorLoginSpace.php');
        exit(0);
    }
    $administrator = $_SESSION['bookinAdministrator'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
        include_once("include/head.php");
        ?>
        <title>Mon espace</title>
    </head>
    <body>
        <?php
            include_once("include/header.php");
        ?>
        <div class="container">
            <h2 id="titleName">Bonjour <?php echo $administrator->getFirstName()." ".$administrator->getLastName() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouvera ici toute les informations te concernant. </p>
        </div>
        <?php
            include("include/footer.php");
        ?>
    </body>
</html>
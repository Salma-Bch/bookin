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
        <div class="container bodyContainer">
            <h2 id="titleName">Bonjour <?php echo $administrator->getFirstName()." ".$administrator->getLastName() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouveras ici toutes les informations te concernant. </p>
            <div class="container clientSpaceTable">
                <?php
                    include("./include/adminInformationsTable.php");
                ?>
                <?php
                include("./include/graphicsTable.php");
                ?>
            </div>
            <div class="col-sm-6 col-xs-12">
                <input type="submit" class="btn modifEtDeco" id="ajoutAdmin" name="submit" onclick="location.href='./administratorAccountCreationSpace.php'" value="Ajouter un administrateur" />
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="include/logout.php" method="POST">
                    <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                </form>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>
    </body>
</html>
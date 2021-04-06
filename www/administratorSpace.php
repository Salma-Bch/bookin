<?php
/**
 * @File        administratorSpace.php
 * @package     www
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        05/04/2021
 * @Brief       Espace personnel de l'administrateur.
 * @Details     Permet l'affichage des informations personnelles de l'administrateur et des statistiques de l'application web Book'In.
 *              L'administrateur a également la possibilité d'ajouter des administrateurs en leur créant un compte et de se déconnecter.
 */

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
                    include("./include/administratorTables.php");
                ?>
            </div>
            <div class="col-sm-6 col-xs-12">
                <input type="submit" class="btn modifEtDeco" id="ajoutAdmin" name="submit" onclick="location.href='./administratorAccountCreationSpace.php'" value="Ajouter un administrateur" />
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="include/adminLogout.php" method="POST">
                    <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                </form>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>
    </body>
</html>
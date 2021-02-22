<?php
    /**
     * \file      clientSpace.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace personnel de l'utilisateur.
     * \details   Mes informations personnelles
     */
include_once('./class/model/Client.php');

session_start();

    if(!isset($_SESSION['bookinClient'])){
        header('Location: ./clientLoginSpace.php');
        exit(0);
    }
    $client = $_SESSION['bookinClient'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
        include_once("ressources/include/head.php");
        ?>
        <title>Mon espace</title>
    </head>
    <body>
        <?php
            include_once("ressources/include/header.php");
        ?>
        <div class="container">
            <h2 id="titleName">Bonjour <?php echo $client->getFirstName()." ".$client->getLastName() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouvera ici toute les informations te concernant. </p>
        </div>
        <div class="container">
            <table class="table table-dark" id="a">
                <tbody id='tableauInfo'>
                    <tr>
                        <td id="tabNom"><b>Nom :</b> <?php echo $client->getLastName() ?></td>
                        <td id="Tabprenom"><b>Prénom :</b> <?php echo $client->getFirstName() ?></td>
                    </tr>
                    <tr>
                        <td id="tabMail"><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
                        <td id="tabNumClient"><b>Id :</b> <?php echo $client->getClientId();?></td>
                    </tr>
                    <tr>
                        <td id="tabNumClient"><b>Profession :</b> <?php echo $client->getProfession();?></td>
                        <td id="tabMail"><b>Sexe :</b> <?php echo $client->getSex();?></td>
                    </tr>
                </tbody>
            </table>
            <div class="col-sm-6 col-xs-12">
                <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Modifier mes informations" onclick="showModifInfosForm()" />
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="include/logout.php" method="POST">
                    <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                </form>
            </div>
        </div>
        <?php
        include("ressources/include/footer.php");
        ?>
    </body>
</html>
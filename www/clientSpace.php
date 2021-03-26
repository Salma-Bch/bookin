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

    include_once('./class/model/Client.php');
    include_once("./include/includeFiles.php");

    session_start();

    if(!isset($_SESSION['bookinClient'])){
        header('Location: ./clientLoginSpace.php');
        exit(0);
    }
    $client = $_SESSION['bookinClient'];

    $daoFactory = DAOFactory::getInstance();
    $buysDao = $daoFactory->getPurchaseDao();
    $buys = $buysDao->getClientPurchases($client->getClientId());

    $evaluatesDao = $daoFactory->getEvaluatesDao();
    $evaluates = $evaluatesDao->find(null, Format::getFormatId(8,$client->getClientId()));

    $likesDao = $daoFactory->getLikesDao();
    $likes = $likesDao->find( Format::getFormatId(8,$client->getClientId()), null);

    $booksDao = $daoFactory->getBookDao();
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
            <h2 id="titleName">Bonjour <?php echo $client->getFirstName()." ".$client->getLastName() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouvera ici toute les informations te concernant. </p>
        </div>
        <div class="container clientSpaceTable">
            <?php
                include("./include/clientInformationsTable.php");
            ?>
            <?php
                include("./include/likedCategoriesAndTagsTable.php");
            ?>
            <?php
                include("./include/buysBooksTable.php");
            ?>
            <?php
                include ("./include/likedBooksTable.php");
            ?>
            <div class="col-sm-6 col-xs-12">
                <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Modifier mes informations" />
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="include/logout.php" method="POST">
                    <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                </form>
            </div>
        </div>
        <?php
            include("include/footer.php");
            include("include/categoryModal.php");
            include("include/tagModal.php");
        ?>
    </body>
</html>
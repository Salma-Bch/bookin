<?php
    /**
     * \file      shoppingSpace.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace d'achat de l'application web Book'In.
     * \details   L'utilisateur peut effectuer des achats de livre.
     */

    use dao\DAOFactory;
    use utility\Format;

    include_once("./include/includeFiles.php");

    session_start();

    if(!isset($_SESSION['bookinClient'])){
        header('Location: ./clientLoginSpace.php');
        exit(0);
    }
    $client = $_SESSION['bookinClient'];
    $bookId = $_GET['bookId'];
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $book = $bookDao->find(Format::getFormatId(8,$bookId));
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
            <p>Effectuez vos achat dans cette espace.</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 livres">
                    <img src="<?php echo $book->getImagePath(); ?>"  style="width: 140px;height: 190px;">
                </div>
                <div class="col-md-6 livres">
                    <p><b>Titre : <?php echo $book->getTitle(); ?></b></p>
                    <p><b>Auteur : <?php echo $book->getAuthor(); ?></b></p>
                    <p><b>Catégorie : <?php echo $book->getCategoryName(); ?></b></p>
                    <p><b>Nombre de page : <?php echo $book->getNumberPages(); ?></b></p>
                    <p><b>Tranche d'âge : <?php echo $book->getAgeRange(); ?></b></p>
                    <p><b>Prix : <?php echo $book->getPrice(); ?>€</b></p>
                </div>
                <div class="col-md-6">
                    <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Retour" onclick="searchSpace.php" />
                </div>
                <div class="col-md-6">
                    <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Acheter" />
                </div>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>
    </body>
</html>
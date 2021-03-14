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
                <p><b>Tranche d'âge : <?php echo $book->getAgeRange(); ?></b></p>
                <p><b>Nombre de page : <?php echo $book->getNumberPages(); ?></b></p>
                <p><b>Prix : <?php echo $book->getPrice(); ?>€</b></p>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Retour" onclick="searchSpace.php" />
            </div>
            <div class="col-md-6">
                <button class="btn payer" name="submit" type="submit" data-toggle="modal" data-target="#dialogModal" >Payer</button>
            </div>
        </div>
    </div>
    <?php
        include("include/footer.php");
    ?>
    <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xd7;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Votre réservation</h4>
                </div>
                <div class="modal-body">
                    <svg style="vertical-align: middle; margin-right: 10px" id="modifChecked" width="30" height="30" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    <svg style="vertical-align: middle; margin-right: 10px" id="modifFailed" width="30" height="30" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                    <p id="infosMaj" style="display: inline-block;">La réservation a été effectué avec succés.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
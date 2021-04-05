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
use model\Purchase;
use utility\Format;

    include_once("./include/includeFiles.php");

    session_start();
    if(!isset($_GET['bookId']))
        header('Location: ./index.php');
    $client = $_SESSION['bookinClient'];
    $bookId = $_GET['bookId'];
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $book = $bookDao->find(Format::getFormatId(8,$bookId));
    if(!isset($book))
        header('Location: ./index.php');

    if(isset($_GET['source']))
        $source = $_GET['source'];
    else
        $source = "other";

    if(!isset($_SESSION['bookinClient'])){
        header('Location: ./clientLoginSpace.php?bookId='.$book->getBookId().'&source='.$source);
        exit(0);
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Espace achat</title>
    </head>
    <body>
        <?php
            include_once("include/header.php");
        ?>
        <div class="head_location"></div>
        <div class="container bodyContainer">
            <h2 id="titleName">Bonjour <?php echo $client->getFirstName()." ".$client->getLastName() ?>.</h2>
            <p>Effectuez vos achat dans cette espace.</p>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 livres">
                        <img src="<?php echo $book->getImagePath(); ?>"  alt="image du livre <?php echo $book->getBookId(); ?>"  style="width: 140px;height: 190px;"/>
                    </div>
                    <div class="col-md-6 livres">
                        <p><b>Titre : <?php echo $book->getTitle(); ?></b></p>
                        <p><b>Auteur : <?php echo $book->getAuthor(); ?></b></p>
                        <p><b>Catégorie : <?php echo $book->getCategoryName(); ?></b></p>
                        <p><b>Nombre de page : <?php echo $book->getNumberPages(); ?></b></p>
                        <p><b>Tranche d'âge : <?php echo $book->getAgeRange(); ?></b></p>
                        <p><b>Prix : <?php echo $book->getPrice(); ?>€</b></p>
                    </div>
                    <?php /*
                        //Regarde si ya deja un livre acheter pour CE client
                        $purchaseDao = $daoFactory->getPurchaseDao();
                        $purchase = $purchaseDao->find($client->getClientId(), $book->getBookId());

                        //Si deja acheté, incrémenté quantité et incrémenté le montant du prix du livre (update)
                        if(isset($purchase)){
                            $purchase->setQuantity($purchase->getQuantity()+1);
                            $purchase->setAmount($purchase->getAmount() + $book->getPrice());
                            $updated = $purchaseDao->update($purchase);
                        }
                        else{
                            //Si jamais acheté, créée un achat avec le montant = prix du livre et quantité = 1 (CREATE)
                            $purchase = new Purchase($client->getClientId(),$book->getBookId(), $book->getPrice(),1);
                            $purchased = $purchaseDao->create($purchase);
                        }*/
                    ?>
                    <div class="col-md-6">
                        <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Retour" onclick="goBack()" />
                    </div>
                    <div class="col-md-6">
                        <form class='form-signin' id="purchaseByClientInfo" onsubmit="return false">
                            <input type="hidden" name="bookId" value="<?php echo $book->getBookId() ?>" />
                            <input type="submit" class="btn modifEtDeco" name="submit" value="Acheter" onclick="sendBuysData()"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include("include/footer.php");
        ?>

        <script>
            function goBack(){
                var previousUrl = "<?php echo $source; ?>";

                if(previousUrl === "searchSpace")
                    window.location.assign("searchSpace.php");
                else
                    window.location.assign("index.php");

            }
            function sendBuysData() {
                var formData = $("#purchaseByClientInfo").serialize();
                $.ajax({
                    type: 'post',
                    url: './include/purchaseBookByClient.php',
                    data: formData,
                    success: function (response) {
                        if(response === "purchase successful"){}
                            //window.location.assign("shoppingSpace.php");
                        else {
                            //document.getElementById("idOrMdpFalseDiv").style.display = "block";
                        }
                    }
                });

                return false;
            }
        </script>
    </body>
</html>
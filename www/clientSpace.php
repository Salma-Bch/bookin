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
        <div class="container">
            <table class="table table-dark" id="a">
                <tbody id='tableauInfo'>
                    <tr>
                        <td id="tabNom"><b>Nom :</b> <?php echo $client->getLastName() ?></td>
                        <td id="Tabprenom"><b>Prénom :</b> <?php echo $client->getFirstName() ?></td>
                    </tr>
                    <tr>
                        <td id="tabMail"><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
                        <td id="tabNumClient"><b>Id :</b> <?php echo Format::getFormatId(8,$client->getClientId())?></td>
                    </tr>
                    <tr>
                        <td id="tabNumClient"><b>Profession : </b><?php echo $client->getProfession();?></td>
                        <td id="tabMail"><b>Sexe :</b> <?php echo $client->getSex();?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-dark" id="a">
                <tbody id='tableauInfo'>
                    <tr>
                        <td id="tabNom"><b>Catégories aimés :</b>
                            <?php
                                $i=0;
                                while($i < count($likes)) {
                                    echo $likes[$i]->getCategoryName().' ';
                                    $i++;
                                }
                           ?>
                        </td>
                        <td id="Tabprenom"><b>Tags aimés :</b>
                            <?php
                            $tags = $client->getTags();
                            $i=0;
                            while($i < count($tags)) {
                                echo $tags[$i];
                                $i++;
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-dark" id="a">
                <tbody id='tableauInfo'>
                    <tr>
                        <th id="tabNom"><b>Livres achetés :</b></th>
                        <th id="Tabprenom"><b>Livres aimés :</b></th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $i=0;
                            echo '<div class="col-md-11 firstBooksDiv">';
                            while($i < count($buys)) {
                                $bookDisplayed = $booksDao->find(Format::getFormatId(8,$buys[$i]->getBookId()));
                                echo '<div class="col-md-12 secondBooksDiv">';

                                echo '<div class="col-md-8">';
                                    echo '<p style="font-weight: bold;font-size:20px">'.$bookDisplayed->getCategoryName().'</p>';
                                    echo '<p>'.$bookDisplayed->getTitle().'</p>';
                                    echo '<p>'.$bookDisplayed->getAuthor().'</p>';
                                    echo '<p>Prix : '.$bookDisplayed->getPrice().'€</p>';
                                echo '</div>';
                                echo '<div class="col-md-3">';
                                    echo '<img class="buysBooksDipslayedClientSpace" src="'.$bookDisplayed->getImagePath().'"  alt="...">';
                                echo '</div>';
                                echo '<div class="col-md-1">';
                                    echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/like.png"  alt="..."></a>';
                                    echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/dislike.png"  alt="..."></a>';
                                echo '</div>';
                                $i++;
                                echo '</div>';
                            }
                            echo '</div>';
                            ?>
                        </td>
                        <td>
                            <?php
                            $i=0;
                            echo '<div class="col-md-12" style="border-left:solid">';

                            while($i < count($evaluates)) {
                                $bookDisplayed = $booksDao->find(Format::getFormatId(8,$evaluates[$i]->getBookId()));
                                echo '<div class="col-md-12 secondBooksDiv">';

                                echo '<div class="col-md-8">';
                                echo '<p style="font-weight: bold;font-size:20px">'.$bookDisplayed->getCategoryName().'</p>';
                                echo '<p>'.$bookDisplayed->getTitle().'</p>';
                                echo '<p>'.$bookDisplayed->getAuthor().'</p>';
                                echo '<p>Prix : '.$bookDisplayed->getPrice().'€</p>';
                                echo '</div>';
                                echo '<div class="col-md-3">';
                                echo '<img class="buysBooksDipslayedClientSpace" src="'.$bookDisplayed->getImagePath().'"  alt="...">';
                                echo '</div>';
                                echo '<div class="col-md-1">';
                                echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/croix.png"  alt="..."></a>';
                                echo '</div>';
                                $i++;
                                echo '</div>';
                            }
                            echo '</div>';
                            ?>
                        </td>
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
        include("include/footer.php");
        ?>
    </body>
</html>
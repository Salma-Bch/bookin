<?php
    use utility\Format;
?>

<div class="container clientSpaceTable">
    <div class="col-md-12">
        <h3>Informations personnelles </h3>
    </div>
    <table class="table" id="tableauInfo">
        <tbody>
            <tr>
                <td id="tab_laste_name"><b>Nom :</b> <?php echo $client->getLastName() ?></td>
                <td id="tab_first_name"><b>Prénom :</b> <?php echo $client->getFirstName() ?></td>
            </tr>
            <tr>
                <td id="tab_mail"><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
                <td id="tab_id"><b>Id :</b> <?php echo Format::getFormatId(8,$client->getClientId())?></td>
            </tr>
            <tr>
                <td id="tab_profession"><b>Profession : </b><?php echo $client->getProfession();?></td>
                <td id="tab_sex"><b>Sexe :</b> <?php echo $client->getSex();?></td>
            </tr>
        </tbody>
    </table>
    <div class="col-md-6">
        <h3>Catégories aimées</h3>
    </div>
    <div class="col-md-6">
        <h3>Tags aimés</h3>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="col-md-6" style="border-right:solid">
                <?php
                    $i=0;
                    while($i < count($likes)) {
                        echo '<div class="col-md-4 categoryAndTag">'.$likes[$i]->getCategoryName().' '.'</div>';
                        $i++;
                    }
                ?>
                <button class="col-md-12 categoryAndTagButton" onclick="addCategory()"><b>+</b></button>
            </td>
            <td class="col-md-6" style="border-left:solid">
                <?php
                    $tags = $client->getTags();
                    $i=0;
                    while($i < count($tags)) {
                        echo '<div class="col-md-4 categoryAndTag">'.$tags[$i].' '.'</div>';
                        $i++;
                    }
                ?>
                <button class="col-md-12 categoryAndTagButton" onclick="addTag()"><b>+</b></button>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="col-md-12">
        <h3>Livres achetés</h3>
    </div>
    <table class="table">
        <tbody>
            <tr><td>
                <?php
                $i=0;
                echo '<div class="col-md-12">';
                while($i < count($buys)) {
                    $bookDisplayed = $booksDao->find(Format::getFormatId(8,$buys[$i]->getBookId()));
                    echo '<div class="col-md-6 booksDiv1">';
                    echo '<div class="col-md-8">';
                    echo '<p style="font-weight: bold;font-size:20px">'.$bookDisplayed->getCategoryName().'</p>';
                    echo '<p>'.$bookDisplayed->getTitle().'</p>';
                    echo '<p>'.$bookDisplayed->getAuthor().'</p>';
                    echo '<p>Prix : '.$bookDisplayed->getPrice().'€</p>';
                    echo '</div>';
                    echo '<div class="col-md-3">';
                    echo '<img class="buysBooksDipslayedClientSpace" src="'.$bookDisplayed->getImagePath().'"  alt="..."/>';
                    echo '</div>';
                    echo '<div class="col-md-1">';
                    echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/like.png"  alt="..."/></a>';
                    echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/dislike.png"  alt="..."/></a>';
                    echo '</div>';
                    $i++;
                    echo '</div>';
                }
                echo '</div>';
                ?>
            </td></tr>
        </tbody>
    </table>
    <div class="col-md-12">
        <h3>Livres aimés</h3>
    </div>
    <table class="table">
        <tbody>
            <tr><td>
                <?php
                    $i=0;
                    echo '<div class="col-md-12">';
                    while($i < count($evaluates)) {
                        $bookDisplayed = $booksDao->find(Format::getFormatId(8,$evaluates[$i]->getBookId()));
                        echo '<div class="col-md-6 booksDiv1">';
                        echo '<div class="col-md-8">';
                        echo '<p style="font-weight: bold;font-size:20px">'.$bookDisplayed->getCategoryName().'</p>';
                        echo '<p>'.$bookDisplayed->getTitle().'</p>';
                        echo '<p>'.$bookDisplayed->getAuthor().'</p>';
                        echo '<p>Prix : '.$bookDisplayed->getPrice().'€</p>';
                        echo '</div>';
                        echo '<div class="col-md-3">';
                        echo '<img class="buysBooksDipslayedClientSpace" src="'.$bookDisplayed->getImagePath().'"  alt="..."/>';
                        echo '</div>';
                        echo '<div class="col-md-1">';
                        echo '<a href="index.php"><img class="likeAndDislike" src="ressources/images/croix.png"  alt="..."/></a>';
                        echo '</div>';
                        $i++;
                        echo'</div>';
                    }
                    echo '</div>';
                ?>
            </td></tr>
        </tbody>
    </table>
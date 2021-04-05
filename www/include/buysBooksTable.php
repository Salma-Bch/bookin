<?php
    use utility\Format;
?>
<table class="table">
    <tbody>
    <tr><th><b>Livres achetés :</b></th></tr>
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
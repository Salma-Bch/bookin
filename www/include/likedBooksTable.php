<?php
    use utility\Format;
?>
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
                echo '</div>';
                $bookDisplayed = $booksDao->find(Format::getFormatId(8,$evaluates[$i]->getBookId()));
                echo '<div class="col-md-6 booksDiv2">';
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
                echo '</div>';
            }
            echo '</div>';
            ?>
        </td></tr>
    </tbody>
</table>
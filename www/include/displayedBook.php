<?php

use controller\Suggestion;
use model\Client;

    $client = $_SESSION['bookinClient'];
    var_dump($client);
    $suggestion = new Suggestion($client);
    $books = $suggestion->suggest();

    echo '<h2>Sélectionnés pour vous !</h2>';
    echo '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">';
    echo '<div class="carousel-indicators">';
    echo '<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
    echo '<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>';
    echo '<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>';
    echo '<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3" aria-label="Slide 4"></button>';
    echo '</div>';
    echo '<div class="carousel-inner partie_suggestions">';

    $page = 1;
    $i=0;
    $nbrRow = 2;
    $nbrBooksPerRow = 3;

    while($i < count($books)) {
        $class = " active";
        if($page > 1)
            $class = "";

        echo '<div class="carousel-item'.$class.'">';
        for($k=0 ; $k<$nbrRow ; $k++) {
            echo '<div>';
            for ($j = 0; $j < $nbrBooksPerRow; $j++) {
                if(!isset($books[$i]))
                    break;

                echo '<div class="displayIndexBook">';
                echo '<p class="displayTitleAndCategory">'.$books[$i]->getTitle().'</p>';
                echo '<p class="displayAuthorAndPrice">'.$books[$i]->getAuthor().'</p>';
                echo '<a href="./shoppingSpace.php?bookId='.$books[$i]->getBookId().'&source=index"><img class="displayImage" src="'.$books[$i]->getImagePath().'"  alt="image du livre '.$books[$i]->getBookId().'"/></a>';
                echo '<p class="displayAuthorAndPrice">'.$books[$i]->getPrice().'€</p>';
                echo '<p class="displayTitleAndCategory">'.$books[$i]->getCategoryName().'</p>';
                echo '</div>';
                $i++;
            }
            echo '</div>';
        }
        echo '</div>';
        $page++;
    }

echo '</div>';
echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">';
echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
echo '<span class="visually-hidden">Previous</span>';
echo '</button>';
echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">';
echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
echo '<span class="visually-hidden">Next</span>';
echo '</button>';
echo '</div>';
<?php

use controller\Suggestion;

    $suggestion = new Suggestion();
    $books = $suggestion->suggest();

   /* echo '<div class="col-md-9" id="bookSearched" style="background-color: #d6d6d6">';
    foreach ($books as $book) {
        echo '<div class="col-md-4 livres">' .
            '<p>Titre : '.$book->getTitle().'</p>' .
            '<img src="'.$book->getImagePath().'"  style="width: 140px;height: 190px;">' .
            '<p>'.$book->getPrice().'€</p>' .
            '</div>';
    }
    echo '</div>';*/

echo '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">';
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
            echo '<img src="'.$books[$i]->getImagePath().'"  alt="...">';
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
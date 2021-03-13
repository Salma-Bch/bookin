<?php

use controller\Suggestion;
use dao\DAOFactory;
use model\Book;

include_once('./class/utility/Format.php');
include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/dao/object/ClientDao.php');
include_once('./class/dao/object/ClientDaoImpl.php');
include_once('./class/model/Client.php');
include_once('./class/model/Book.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');
include_once('./class/controller/Suggestion.php');
include_once('./class/controller/ContentModel.php');
include_once('./class/utility/Math.php');

    $suggestion = new Suggestion();
    $books = $suggestion->suggest();

    echo '<div class="col-md-9" id="bookSearched" style="background-color: #d6d6d6">';
    foreach ($books as $book) {
        echo '<div class="col-md-4 livres">' .
            '<p>Titre : '.$book->getTitle().'</p>' .
            '<img src="'.$book->getImagePath().'"  style="width: 140px;height: 190px;">' .
            '<p>'.$book->getPrice().'€</p>' .
            '</div>';
    }
    echo '</div>';


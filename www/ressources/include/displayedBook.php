<?php
use dao\DAOFactory;
use model\Book;

include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/model/Book.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');

    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $books = $bookDao->getAll();
    echo '<div class="col-md-9 bookSearched">';
    foreach ($books as $book) {
        echo '<div class="col-md-4 livres">' .
            '<p>'.$book->getTitle().'</p>' .
            '<img src="'.$book->getImagePath().'"  style="width: 140px;height: 190px;">' .
            '<p>'.$book->getPrice().'€</p>' .
            '</div>';
    }
    echo '</div>';


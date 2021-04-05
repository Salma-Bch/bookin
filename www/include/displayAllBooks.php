<?php
use dao\DAOFactory;
use model\Book;

include_once('./class/utility/Format.php');
include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/model/Book.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/dao/exception/DAOException.php');

    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $books = $bookDao->getAll();
    echo '<div class="col-md-9" id="bookSearched" style="background-color: #d6d6d6">';
    foreach ($books as $book) {
        echo '<div class="col-md-4 livres" onclick="location.href=\'./shoppingSpace.php?bookId='.$book->getBookId().'&source=searchSpace\';">' .
            '<p class="displayTitleAndCategory">'.$book->getTitle().'</p>' .
            '<p class="displayAuthorAndPrice">'.$book->getAuthor().'</p>' .
            '<img class="displayImage" src="'.$book->getImagePath().'">' .
            '<p class="displayAuthorAndPrice">Prix : '.$book->getPrice().'€</p>' .
            '<p class="displayTitleAndCategory">'.$book->getCategoryName().'</p>' .
            '</div>';
    }
    echo '</div>';
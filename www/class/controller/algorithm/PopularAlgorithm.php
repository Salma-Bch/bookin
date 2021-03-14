<?php

namespace controller;

use dao\DAOFactory;
use utility\Format;

class PopularAlgorithm {

    /**
     * PopularAlgorithm constructor.
     */
    public function __construct() {
    }

    /**
     * Retourne les livres les plus achetés par les clients.
     *
     * @return array
     */
    public function suggest(int $nbrofBooks=null):array {
        $daoFactory = DAOFactory::getInstance();
        $purchasesDao = $daoFactory->getPurchaseDao();
        $bookDao = $daoFactory->getBookDao();
        if(isset($nbrofBooks))
            $mostPurchasedBooks = $purchasesDao->getMostPurchasedBooks($nbrofBooks);
        else
            $mostPurchasedBooks = $purchasesDao->getMostPurchasedBooks();

        $books = array();
        foreach ($mostPurchasedBooks as $purchasedBook){
            $book = $bookDao->find(Format::getFormatId(8,$purchasedBook->getBookId()));
            array_push($books, $book);
        }
        return $books;
    }
}
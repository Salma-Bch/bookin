<?php

namespace controller;

use dao\DAOFactory;

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
        if(isset($nbrofBooks))
            $mostPurchasedBooks = $purchasesDao->getMostPurchasedBooks($nbrofBooks);
        else
            $mostPurchasedBooks = $purchasesDao->getMostPurchasedBooks();
        return $mostPurchasedBooks;
    }
}
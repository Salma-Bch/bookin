<?php

/**
 * Class        PopularAlgorithm
 * @File        PopularAlgorithm.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion de livres.
 * @Details     Suggestion en fonction de la popularité des livres.
 */

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
     * @param       int $nbrOfBooks
     * @Brief       Retourne un tableau de livres en fonction des livres populaire.
     * @Details     Cette méthode récupère les livres les plus achetés à l'aide de la méthode getMostPurchasedBooks().
     *              Les id de chaque livre sont ensuite récupérés afin de trouver le livre correspondant avec la méthode find().
     *              Ces livres sont ensuite placer dans un tableau qui sera renvoyé.
     * @return      array
     */
    public function suggest(int $nbrOfBooks=null):array {
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
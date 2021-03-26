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
     * @param       int|null $nbrOfBooks
     * @return      array
     * @Brief       Retourne un tableau des livres les plus populaire.
     * @Details     Cette méthode récupère les livres les plus achetés à l'aide de la méthode getMostPurchasedBooks().
     *              Les id de chaque livre sont ensuite récupérés afin de trouver le livre correspondant grâce à la méthode find().
     *              Ces livres sont ensuite placer dans un tableau qui sera retourné.
     */
    public function suggest(int $nbrOfBooks=null):array {
        $daoFactory = DAOFactory::getInstance();
        $purchasesDao = $daoFactory->getPurchaseDao();
        $evaluatesDao = $daoFactory->getEvaluatesDao();
        $bookDao = $daoFactory->getBookDao();
        $nbrOfBestRatedBooks = intdiv($nbrOfBooks, 2);
        if(isset($nbrOfBooks)) {
            $mostPurchasedBooksId = $purchasesDao->getMostPurchasedBooks($nbrOfBooks - $nbrOfBestRatedBooks);
            $bestRatedBooksId = $evaluatesDao->getBestRated($nbrOfBestRatedBooks, $mostPurchasedBooksId);
        }
        else {
            $mostPurchasedBooksId = $purchasesDao->getMostPurchasedBooks();
            $bestRatedBooksId = $evaluatesDao->getBestRated(3);
        }

        $books = array();
        foreach ($mostPurchasedBooksId as $purchasedBook){
            $book = $bookDao->find(Format::getFormatId(8,$purchasedBook));
            array_push($books, $book);
        }
        foreach ($bestRatedBooksId as $ratedBook){
            $book = $bookDao->find(Format::getFormatId(8,$ratedBook));
            array_push($books, $book);
        }
        return $books;
    }
}
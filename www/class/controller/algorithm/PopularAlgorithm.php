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
     * @Details     Cette méthode récupère les livres les plus achetés à l'aide de la méthode getMostPurchasedBooks() et les livres
     *              les mieux notés grâce à l'aide de la méthode getBestRated().
     *              Les id de chaque livre sont ensuite récupérés afin de trouver le livre correspondant grâce à la méthode find().
     *              Ces livres sont ensuite placer dans un tableau qui sera retourné.
     */
    public static function suggest(int $nbrOfBooks=null):?array {
        if(isset($nbrOfBooks)) {
            $daoFactory = DAOFactory::getInstance();
            $purchasesDao = $daoFactory->getPurchaseDao();
            $evaluatesDao = $daoFactory->getEvaluatesDao();
            $bookDao = $daoFactory->getBookDao();

            /*  On separe le nombre de livre a retourné en 2 partie : une moitié de livres
                les plus acheté et l'autre moitié des livres les mieux notés. */
            $nbrOfBestRatedBooks = intdiv($nbrOfBooks, 2);
            $nbrOfMostPurchasedBooks = $nbrOfBooks - $nbrOfBestRatedBooks;

            //  On récupère les id des livres les mieux noté et les plus acheté.
            $mostPurchasedBooksId = $purchasesDao->getMostPurchasedBooks($nbrOfMostPurchasedBooks);
            $bestRatedBooksId = $evaluatesDao->getBestRated($nbrOfBestRatedBooks, $mostPurchasedBooksId);
            $booksIdEntry = array_merge($mostPurchasedBooksId,$bestRatedBooksId);

            return $bookDao->findIn($booksIdEntry);
        }
        return null;
    }
}
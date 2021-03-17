<?php

/**

 * Class        RandomAlgorithm
 * @File        RandomAlgorithm.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion aléatoire de livres
 * @Details     Suggère des livres aléatoirement à l'utilisiteur
 */
namespace controller;

use dao\DAOFactory;
use model\Client;
use utility\Math;



class RandomAlgorithm {

    private array $books;

    /**
     * RandomAlgorithm constructor.
     */
    public function __construct(array $books) {
        $this->books = $books;
    }

    /**
     * @param       int $nbrOfBook
     * @Brief       Retourne un tableau de livres aléatoirement
     * @Details     Cette méthode récupère l'ensemble des livres contenus dans la base de données puis renvoie des livres sélectionnés aléatoirement
     * @return      array
     */
    public function suggest(int $nbrOfBook):array{
        $booksToReturn = array();
        $books = $this->books;

        $randomKeys = array_rand($books, $nbrOfBook);
        foreach($randomKeys as $randomKey){
            array_push($booksToReturn, $books[$randomKey]);
        }
        return $booksToReturn;
    }

}
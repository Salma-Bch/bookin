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


class RandomAlgorithm {

    private array $books;

    /**
     * RandomAlgorithm constructor.
     * @param       array $books
     */
    public function __construct(array $books) {
        $this->books = $books;
    }

    /**
     * @param       int $nbrOfBook
     * @Brief       Retourne un tableau de livres de manière aléatoire.
     * @Details     Cette méthode récupère l'ensemble des livres contenus dans la base de données puis renvoie des livres sélectionnés aléatoirement.
     *              Le nombre de livre retourné est passé en paramètre.
     * @return      array
     */
    public function suggest(int $nbrOfBook):array{
        $booksToReturn = array();
        $booksEntry = $this->books;

        $randomKeys = array_rand($booksEntry, $nbrOfBook);
        foreach($randomKeys as $randomKey){
            array_push($booksToReturn, $booksEntry[$randomKey]);
        }
        return $booksToReturn;
    }
}
<?php

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
     * Retourne des livres aléatoirement.
     *
     * @param int $nbrOfBook
     * @return array
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
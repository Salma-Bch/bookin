<?php

namespace controller;

use dao\DAOFactory;

class RandomBooksSuggest {

    /**
     * RandomBooksSuggest constructor.
     */
    public function __construct() {
    }

    /**
     * Retourne tout les livres de la base de données.
     *
     * @return array
     */
    public function getAllBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $booksDao = $daoFactory->getBookDao();
        $books = $booksDao->getAll();
        $booksReturned = array();
        foreach ($books as $book){
            array_push($booksReturned, $book);
        }
        return $booksReturned;
    }

}
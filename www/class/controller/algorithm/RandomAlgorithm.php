<?php

namespace controller;

use dao\DAOFactory;
use model\Client;

class RandomAlgorithm {

    private Client $client;
    private array $books;

    /**
     * RandomAlgorithm constructor.
     */
    public function __construct() {
    }

    /**
     * Retourne tout les livres de la base de données.
     *
     * @return array
     */
    public function getAllBooks():array{
        //Récupere la liste de tous les livres
        $daoFactory = DAOFactory::getInstance();
        $booksDao = $daoFactory->getBookDao();
        $books = $booksDao->getAll();

        //Faire un tableau de nombre aleatoire de nbQuonVeut allant de 0 à count($books)-1


        //Récuperer les livres a retourner dans un array et les retourner
        $booksReturned = array();
        foor(){

        }
        return $booksReturned;
    }

}
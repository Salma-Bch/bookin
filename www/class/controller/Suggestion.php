<?php

/**
 * Class        Suggestion
 * @File        Suggestion.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion de livres
 * @Details     Rassemble les 4 sous-algorithmes de suggestion dans un algorithme principal
 */
namespace controller;

use dao\DAOFactory;
use model\Client;

/**
 * Class Suggestion
 * @package controller
 */
class Suggestion {

    private Client $client;
    private array $books;

    /**
     * Suggestion constructor.
     */
    public function __construct(Client $client) {
        $daoFactory = DAOFactory::getInstance();
        $bookDao = $daoFactory->getBookDao();
        $this->books = $bookDao->getAll();
        $this->client = $client;
    }

    /**
     * @Brief       Récupère les livres retounés par les sous-algorithmes.
     * @Details     Cette méthode appelle les différents sous-algorithmes et retourne un tableau des livres suggérés.
     * @return      array
     */
    public function suggest():array{
        // $userAlgorithm = new UserAlgorithm($this->books, $this->client);
        $contentAlgorithm = new ContentAlgorithm($this->books, $this->client);
        $popularAlgorithm = new PopularAlgorithm();
        $randomAlgorithm = new RandomAlgorithm($this->books);

        $booksToDisplay = $popularAlgorithm->suggest(2);
        $booksToDisplay = array_merge($booksToDisplay, $randomAlgorithm->suggest(2));
        $booksToDisplay = array_merge($booksToDisplay, $contentAlgorithm->suggest());

        return $booksToDisplay;
    }



}
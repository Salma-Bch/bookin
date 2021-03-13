<?php

namespace controller;

use dao\DAOFactory;
use model\Client;

class Suggestion {
    private Client $client;
    private array $books;

    /**
     * Suggestion constructor.
     */
    public function __construct() {
        $daoFactory = DAOFactory::getInstance();
        $bookDao = $daoFactory->getBookDao();
        $this->books = $bookDao->getAll();
        $clientDao = $daoFactory->getClientDao();
        $this->client = $clientDao->find("m.lekmiti@hotmail.com", "1234");
    }

    public function suggest():array{
        // $userAlgorithm = new UserAlgorithm($this->books, $this->client);
        $contentAlgorithm = new ContentAlgorithm($this->books, $this->client);
        $popularAlgorithm = new PopularAlgorithm();
        $randomAlgorithm = new RandomAlgorithm($this->books);

        $booksToDisplay = $popularAlgorithm->suggest(2);
        $booksToDisplay = array_merge($booksToDisplay, $randomAlgorithm->suggest(2));
        $booksToDisplay = array_merge($booksToDisplay, $contentAlgorithm->suggest());

        var_dump($booksToDisplay);
        return $booksToDisplay;
    }



}
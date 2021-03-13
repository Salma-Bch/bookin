<?php

namespace controller;

use dao\DAOFactory;
use model\Client;
use utility\Math;

class Suggestion {
    private Client $client;
    private array $books;

    /**
     * Suggestion constructor.
     * @param array $books
     * @param array $likedBooks
     * @param array $purchase
     */
    public function __construct() {
        $daoFactory = DAOFactory::getInstance();
        $bookDao = $daoFactory->getBookDao();
        $this->books = $bookDao->getAll();

        $clientDao = $daoFactory->getClientDao();
        $this->client = $clientDao->find("m.lekmiti@hotmail.com", "1234");
    }

    public function suggest():array{
        $booksToDisplay = array();

        $contentAlgorithm = new ContentAlgorithm($this->books, $this->client);

       /* if($priceModel != -1) {
            $booksToDisplay = $this->priceBased($priceModel, $this->books, 5);
        }*/

        $books = $contentAlgorithm->suggest();
        var_dump($books);
        return $booksToDisplay;
    }



}
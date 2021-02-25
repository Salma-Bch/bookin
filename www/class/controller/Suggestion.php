<?php

namespace controller;

use dao\DAOFactory;
use model\Client;
use controller\ContentTypeModelling;

class Suggestion {
    private Client $client;
    private array $books;
    private array $likedBooks;
    private array $purchase;

    /**
     * Suggestion constructor.
     * @param array $books
     * @param array $likedBooks
     * @param array $purchase
     */
    //public function __construct(array $books, array $likedBooks, array $purchase)
    public function __construct()
    {
        $daoFactory = DAOFactory::getInstance();
        $bookDao = $daoFactory->getBookDao();
        $this->books = $bookDao->getAll();

        $clientDao = $daoFactory->getClientDao();
        $this->client = $clientDao->find("m.lekmiti@hotmail.com", "1234");

    }

    public function suggest():array{

        $contentTypeModelling = new ContentTypeModelling($this->client);
        echo "Catégorie model : ".$contentTypeModelling->getCategoryModel();
        echo "Age model : ".$contentTypeModelling->getAgeRangeModel();
        echo "Prix model : ".$contentTypeModelling->getPriceModel();
        return array();
    }


}
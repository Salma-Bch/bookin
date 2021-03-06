<?php

namespace controller;

use dao\DAOFactory;
use dao\object\BookDao;
use dao\object\PurchaseDao;
use model\Book;
use model\Client;
use controller\ContentTypeModelling;
use model\Purchase;
use utility\Math;

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

        $priceModel = $contentTypeModelling->getPriceModel();
        if($priceModel != -1) {
            $booksToDisplay = $this->priceBased($priceModel, $this->books, 5);
        }

        return $booksToDisplay;
    }

    public function priceBased(int $priceModel, array $books,int $selected):array{
        $prices=array();
        $booksReturned = array();
        foreach ($books as $book){
            array_push($prices, $book->getPrice());
        }
        $nearestPrices = Math::nearestFigure($priceModel, $prices, $selected);
        var_dump($nearestPrices);
        foreach ($books as $book){
            if(in_array($book->getPrice(), $nearestPrices))
                array_push($booksReturned, $book);
        }
        return $booksReturned;
    }

}
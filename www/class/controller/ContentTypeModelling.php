<?php


namespace controller;


use dao\DAOFactory;
use model\Client;
use utility\Format;
use utility\Math;

class ContentTypeModelling
{
    private Client $client;
    private array $likedBooks;
    private array $purchase;

    /**
     * ContentTypeModelling constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCategoryModel():String{
        return "riiiiennn";
    }

    public function getAgeRangeModel():String{
        return "riiiiennn";
    }

    public function getBuysBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $purchaseDao = $daoFactory->getPurchaseDao();
        $purchases = $purchaseDao->getClientPurchases(Format::getFormatId(8,$this->client->getClientId()));
        $booksReturned = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($purchases as $purchase){
            $book = $bookDao->find(Format::getFormatId(8,$purchase->getBookId()));
            array_push($booksReturned,$book);
        }
        return $booksReturned;
    }

    public function getBuysBooksPrices():array{
        $prices = array();
        $buysBooks = $this->getBuysBooks();
        foreach ($buysBooks as $book) {
            array_push($prices, $book->getPrice());
        }
        return $prices;
    }

    public function getPriceModel():float{
        $prices = $this->getBuysBooksPrices();
        if(count($prices)>=1 && Math::getStandardDeviation($prices)<30) {
            echo "Moyenne : ".Math::getAverage($prices);
            return Math::getAverage($prices);
        }
        else
            return -1;
    }

}
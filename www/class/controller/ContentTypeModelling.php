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

    public function getCategoryModel():array{
        //Récuperer depuis la BD category liked du client

        //Récuperer depuis la BD les catégorie des livres aimés
        $categoriesBooksLiked = $this->getLikedBooksCategories();

        //Faire un modèle de catégorie a partir des LIKES, des livres acheté et des livre aimés


    }

    public function getLikedBooksCategories():array{
        $categories = array();
        $booksLiked = $this->getLikedBooks();
        foreach ($booksLiked as $book){
            array_push($categories, $book->getCategory());
        }
        return $categories;
    }

    public function getLikedBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $evaluatesDao = $daoFactory->getEvaluatesDao();
        $evaluates = $evaluatesDao->find(null, $this->client->getClientId());
        $booksReturned = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($evaluates as $evaluation){
            if($evaluation->getSatisfied()) {
                $book = $bookDao->find(Format::getFormatId(8, $evaluation->getBookId()));
                array_push($booksReturned, $book);
            }
        }
        return $booksReturned;
    }

    public function getAgeRangeModel():String{
        //Récuperer depuis la BD les tranches d'ages des livres achetés

        //Faire un modèle de tranche d'age à partir des livre achetés
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
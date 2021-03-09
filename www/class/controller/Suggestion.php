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
        $booksToDisplay = array();
        $contentTypeModelling = new ContentTypeModelling($this->client);
        $categoryModel = $contentTypeModelling->getCategoryModel();

       /* if($priceModel != -1) {
            $booksToDisplay = $this->priceBased($priceModel, $this->books, 5);
        }*/

        $books = $this->categoryBased($categoryModel, $this->books, $contentTypeModelling);
        var_dump($books);
        return $booksToDisplay;
    }

    public function categoryBased(array $categoryModel, array $books, ContentTypeModelling $contentTypeModelling){
        $booksReturned = array();
        // Si la categorie est a 0% je ne met aucun livre de cette dernière

        foreach ($categoryModel as $category){
            if($category != 0){
                foreach ($books as $book){
                    if($book->getCategoryName() == key($categoryModel))
                        array_push($booksReturned, $book);
                }
                next($categoryModel);
            }
        }
        $ageRangeModel = $contentTypeModelling->getAgeRangeModel();
        $booksReturned = $this->ageRangeBased($ageRangeModel, $booksReturned, $contentTypeModelling);
        return $booksReturned;
    }

    public function ageRangeBased(array $ageRangeModel, array $books, ContentTypeModelling $contentTypeModelling){
        $booksReturned = array();
        // Si la tranche d'age est a 0% je ne met aucun livre de cette dernière

        foreach ($ageRangeModel as $ageRange){
            if($ageRange != 0){
                foreach ($books as $book){
                    if($book->getAgeRange() == key($ageRangeModel))
                        array_push($booksReturned, $book);
                }
                next($ageRangeModel);
            }
        }
        $bookSizeModel = $contentTypeModelling->getBookSizeModel();
        $booksReturned = $this->bookSizeBased($bookSizeModel, $booksReturned, $contentTypeModelling);
        return $booksReturned;
    }

    public function bookSizeBased(array $bookSizeModel, array $books, ContentTypeModelling $contentTypeModelling){
        $booksReturned = array();
        // Si la tranche d'age est a 0% je ne met aucun livre de cette dernière

        foreach ($bookSizeModel as $bookSize){
            if($bookSize != 0){
                foreach ($books as $book){
                    if($book->getBookSize() == key($bookSizeModel))
                        array_push($booksReturned, $book);
                }
                next($bookSizeModel);
            }
        }
        $priceModel = $contentTypeModelling->getPriceModel();
        $booksReturned = $this->priceBased($priceModel, $booksReturned, 5);
        return $booksReturned;
    }

    public function priceBased(int $priceModel, array $books,int $selected):array{
        $prices=array();
        $booksReturned = array();
        foreach ($books as $book){
            array_push($prices, $book->getPrice());
        }
        $nearestPrices = Math::nearestFigure($priceModel, $prices, $selected);
        foreach ($books as $book){
            if(in_array($book->getPrice(), $nearestPrices))
                array_push($booksReturned, $book);
        }
        return $booksReturned;
    }

}
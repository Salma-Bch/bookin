<?php


namespace controller;


use dao\DAOFactory;
use model\Client;
use utility\Math;

class ContentAlgorithm {
    private array $books;
    private ContentModel $contentModel;

    public function __construct(array $books, Client $client) {
        $this->books = $books;
        $this->contentModel = new ContentModel($client);
    }

    public function suggest():array{
        $books = $this->categoryBased($this->books, $this->contentModel);
        return $books;
    }

    public function categoryBased(array $books, ContentModel $contentModel){
        $booksReturned = array();
        // Si la categorie est a 0% je ne met aucun livre de cette dernière
        $categoryModel = $contentModel->getCategoryModel();

        foreach ($categoryModel as $category){
            if($category != 0){
                foreach ($books as $book){
                    if($book->getCategoryName() == key($categoryModel))
                        array_push($booksReturned, $book);
                }
                next($categoryModel);
            }
        }
        array_merge($booksReturned, $this->ageRangeBased($booksReturned, $contentModel));
        return $booksReturned;
    }

    public function ageRangeBased(array $books, ContentModel $contentModel){
        $booksReturned = array();
        // Si la tranche d'age est a 0% je ne met aucun livre de cette dernière
        $ageRangeModel = $contentModel->getAgeRangeModel();

        foreach ($ageRangeModel as $ageRange){
            if($ageRange != 0){
                foreach ($books as $book){
                    if($book->getAgeRange() == key($ageRangeModel))
                        array_push($booksReturned, $book);
                }
                next($ageRangeModel);
            }
        }
        array_merge($booksReturned, $this->bookSizeBased($booksReturned, $contentModel));
        return $booksReturned;
    }

    public function bookSizeBased(array $books, ContentModel $contentModel){
        $booksReturned = array();
        // Si la tranche d'age est a 0% je ne met aucun livre de cette dernière
        $bookSizeModel = $contentModel->getBookSizeModel();

        foreach ($bookSizeModel as $bookSize){
            if($bookSize != 0){
                foreach ($books as $book){
                    if($book->getBookSize() == key($bookSizeModel))
                        array_push($booksReturned, $book);
                }
                next($bookSizeModel);
            }
        }
        array_merge($booksReturned, $this->priceBased($booksReturned, 5, $contentModel));
        return $booksReturned;
    }

    public function priceBased(array $books,int $selected, ContentModel $contentModel):array{
        $prices=array();
        $booksReturned = array();
        $priceModel = $contentModel->getPriceModel();
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
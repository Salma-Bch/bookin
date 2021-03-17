<?php


namespace controller;

use dao\DAOFactory;
use model\Client;
use model\Tag;
use utility\Format;
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
        $booksReturned = array_merge($booksReturned, $this->ageRangeBased($booksReturned, $contentModel));
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
        $booksReturned = array_merge($booksReturned, $this->bookSizeBased($booksReturned, $contentModel));
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
        $booksReturned = array_merge($booksReturned, $this->priceBased($booksReturned, 5, $contentModel));
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

    public function tagBased(ContentModel $contentModel){
        $daoFactory = DAOFactory::getInstance();
        $tagDao = $daoFactory->getTagDao();
        $bookDao = $daoFactory->getBookDao();
        $booksToReturn = array();
        $tagsModel = $contentModel->getTagsModel();

        $booksId = "";

        foreach ($tagsModel as $tag){
            if($tag != 0){
                $tagFound = $tagDao->find(key($tagsModel),null);
                if($tagFound != null)
                    $booksId.= ",".$tagFound[0]->getBooksId();
            }
            next($tagsModel);
        }

        $booksId = substr($booksId,1);
        $booksId = explode(",", $booksId);
        if($booksId[0] != "") {
            foreach ($booksId as $bookId) {
                array_push($booksToReturn, $bookDao->find(Format::getFormatId(8, $bookId)));
            }
        }
        return $booksToReturn;
    }

}
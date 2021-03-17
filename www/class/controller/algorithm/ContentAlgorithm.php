<?php

/**
 * Class        ContentAlgorithm
 * @File        ContentAlgorithm.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion de livres.
 * @Details     Suggestion en fonction du contenu des livres achetés et aimés par l'utilisateur.
 */

namespace controller;

use dao\DAOFactory;
use model\Client;
use model\Tag;
use utility\Format;
use utility\Math;

class ContentAlgorithm {
    /**
     * @var array
     */
    private array $books;
    /**
     * @var ContentModel
     */
    private ContentModel $contentModel;

     /**
     * ContentAlgorithm constructor.
     * @param array $books
     * @param Client $client
     */
    public function __construct(array $books, Client $client) {
        $this->books = $books;
        $this->contentModel = new ContentModel($client);
    }

     /**
     * @return      array
     * @Brief       Retourne un tableau de livres
     * @Details     Retourne le tableau de livres obtenu par l'appel de la méthode tagBased
     */
    public function suggest():array{
        return $this->tagBased($this->contentModel);
    }

     /**
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction de tags.
     * @Details     Cette méthode récupère le modèle de tag du client pour créer un tableau de livres.
     *              La méthode categoryBased est ensuite appelé avec le tableau créé et un nouveau tableau de livres est retourné.
     *              Le tableau de livres est remplis à partir des livres présent dans la base de donnée.
     * @return      array
     */
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
        $booksToReturn = $this->categoryBased($this->books, $contentModel);
        return $booksToReturn;
    }

    /**
     * @param array $books
     * @param ContentModel $contentModel
     * @return array
     */
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
        $booksReturned = $this->ageRangeBased($booksReturned, $contentModel);
        return $booksReturned;
    }

    /**
     * @param array $books
     * @param ContentModel $contentModel
     * @return array
     */
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
        $booksReturned =  $this->bookSizeBased($booksReturned, $contentModel);
        return $booksReturned;
    }

    /**
     * @param array $books
     * @param ContentModel $contentModel
     * @return array
     */
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
        $booksReturned =  $this->priceBased($booksReturned, 5, $contentModel);
        return $booksReturned;
    }

    /**
     * @param array $books
     * @param int $selected
     * @param ContentModel $contentModel
     * @return array
     */
    public function priceBased(array $books, int $selected, ContentModel $contentModel):array{
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
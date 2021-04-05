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

    private array $books;
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
     * @Brief       Retourne un tableau de livres.
     * @Details     Retourne le tableau de livres obtenu par l'appel de la méthode tagBased().
     */
    public function suggest():array{
        $booksTagBased = $this->tagBased($this->contentModel);
        $booksCategoryBased = $this->categoryBased($this->books,$this->contentModel);
        $booksAgeRangeBased = $this->ageRangeBased($this->books,$this->contentModel);
        $booksSizeBased = $this->bookSizeBased($this->books,$this->contentModel);
        $booksPriceBased = $this->priceBased($this->books,5,$this->contentModel);
        if($booksPriceBased == null)
            $booksPriceBased = $this->books;
        $books = array_intersect($booksTagBased,$booksCategoryBased);
        $books = array_intersect($books,$booksAgeRangeBased,$booksSizeBased,$booksPriceBased);
        $books = array_intersect($books,$booksSizeBased,$booksPriceBased);
        $books = array_intersect($books,$booksPriceBased);
        return $books;

    }

     /**
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction des tags.
     * @Details     Cette méthode récupère le modèle de tag du client grâçe à la méthode getTagsModel().
     *              Un tableau de livre est ensuite crée en fonction du modèle de tag puis la méthode categoryBased() est appelé avec celui-ci.
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
        return $booksToReturn;
    }

    /**
     * @param       array $books
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction des catégories.
     * @Details     Cette méthode récupère le modèle de catégories du client grâçe à la méthode getCategoryModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont la
     *              catégorie respecte le model de catégorie.
     *              La méthode ageRangeBased() est ensuite appelé avec ce nouveau tableau.
     *              Puis, un tableau de livre récupéré à partir de la méthode précédente est retourné.
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
        return $booksReturned;
    }

    /**
     * @param       array $books
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction des tranches d'âge.
     * @Details     Cette méthode récupère le modèle de tranche d'âge du client grâçe à la méthode getAgeRangeModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont la
     *              tranche d'âge respecte le model de tranche d'âge.
     *              La méthode bookSizeBased() est ensuite appelé avec ce nouveau tableau.
     *              Puis, un tableau de livre récupéré à partir de la méthode précédente est retourné.
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
        return $booksReturned;
    }

    /**
     * @param       array $books
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction du nombre de page des livres du client.
     * @Details     Cette méthode récupère le modèle du nombre de page des livres grâçe à la méthode getBookSizeModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont le
     *              nombre de page respecte le model du nombre de page.
     *              La méthode priceBased() est ensuite appelé avec ce nouveau tableau.
     *              Puis, un tableau de livre récupéré à partir de la méthode précédente est retourné.
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
        return $booksReturned;
    }

    /**
     * @param       array $books
     * @param       int $selected le nombre de prix les plus proche de la moyenne
     * @param       ContentModel $contentModel
     * @Brief       Retourne un tableau de livres en fonction du prix des livres du client.
     * @Details     Cette méthode récupère le modèle de prix des livres grâçe à la méthode getPriceModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont le
     *              prix respecte le model de prix.
     *              Enfin, le tableau de livre filtré est retourné.
     * @return array
     */
    public function priceBased(array $books, int $selected, ContentModel $contentModel):?array{
        $prices=array();
        $booksReturned = array();
        $priceModel = $contentModel->getPriceModel();
        if($priceModel != -1) {
            foreach ($books as $book) {
                array_push($prices, $book->getPrice());
            }
            $nearestPrices = Math::nearestFigure($priceModel, $prices, $selected);
            foreach ($books as $book) {
                if (in_array($book->getPrice(), $nearestPrices))
                    array_push($booksReturned, $book);
            }
            return $booksReturned;
        }
        return null;
    }

}
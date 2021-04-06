<?php

/**
 * Class        UserAlgorithm
 * @File        UserAlgorithm.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion à partir des choix entrés par l'utilisateur lors de la création de son compte.
 * @Details     Suggère des livres en fonction des champs renseignés par l'utilisateur lors de la création de son compte.
 */
namespace controller;


use model\Client;

class UserAlgorithm {
    private UserModel $userModel;
    private array $books;

    /**
     * UserAlgorithm constructor.
     * @param array $books
     * @param Client $client
     */
    public function __construct(array $books, Client $client) {
        $this->books = $books;
        $this->userModel = new UserModel($client);
    }

    /**
     * @param       int $nbrOfBooks
     * @Brief       Retourne un tableau de livres.
     * @Details     Retourne un tableau de livres obtenu par l'appel de toutes les méthodes:
     *              userLikedTags(),userLikedCategory(),userAgeRange(),userProfession().
     *              On mélange les différents éléments retournés par chacun des tableaux afin de récupérer une sélection de livre.
     * @return      array
     */
    public function suggest(int $nbrOfBooks):array{
        if($nbrOfBooks > 0) {
            $booksTagBased = $this->userLikedTags($this->books, $this->userModel);
            $booksCategoryBased = $this->userLikedCategory(array_diff($this->books,$booksTagBased), $this->userModel);
            $booksAgeRangeBased = $this->userAgeRange(array_diff($this->books,$booksCategoryBased),$this->userModel);
            $booksProfessionBased = $this->userProfession(array_diff($this->books,$booksAgeRangeBased),$this->userModel);

            $booksToReturn = array_merge($booksTagBased,$booksCategoryBased);
            $booksToReturn = array_merge($booksToReturn, $booksAgeRangeBased);
            $booksToReturn = array_merge($booksToReturn, $booksProfessionBased);
            shuffle($booksToReturn);
            $sizeTab = count($booksToReturn);
            for ($i = 0; $i < $sizeTab - $nbrOfBooks; $i++) {
                array_pop($booksToReturn);
            }

            return $booksToReturn;
        }
        return array();
    }

    /**
     * @param       array $books
     * @param       UserModel $userModel
     * @Brief       Retourne un tableau de livres en fonction des catégories sélectionnées par l'utilisateur lors de la création de son compte.
     * @Details     Cette méthode récupère le model de catégories aimées par l'utilisateur grâçe à la méthode getUserCategoryModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont la
     *              catégorie respecte le model de catégorie.
     *              Un tableau de livre récupéré à partir de la méthode précédente est retourné.
     * @return      array
     */
    public function userLikedCategory(array $books, UserModel $userModel){
        $booksSelected = array();
        $userCategoryModel = $userModel->getUserCategoryModel();

        foreach ($userCategoryModel as $userCategory) {
            if ($userCategory != 0) {
                foreach ($books as $book) {
                    if ($book->getCategoryName() == key($userCategoryModel))
                        array_push($booksSelected, $book);
                }
            }
            next($userCategoryModel);
        }
        return $booksSelected;
    }

    /**
     * @param       array $books
     * @param       UserModel $userModel
     * @Brief       Retourne un tableau de livres en fonction des tags aimés par l'utilisateur renseigné lors de la création de son compte.
     * @Details     Cette méthode récupère le modèle de tag de l'utilisateur grâçe à la méthode getUserTagModel().
     *              Un tableau de livre est ensuite crée en fonction du modèle de tag de l'utilisateur et est retourné.
     * @return      array
     */
    public function userLikedTags(array $books, UserModel $userModel){
        $booksSelected = array();
        $userTagModel = $userModel->getUserTagModel();

        foreach ($userTagModel as $userTag){
            if($userTag != 0){
                foreach ($books as $book){
                    if($book->getTags() == key($userTagModel))
                        array_push($booksSelected, $book);
                }
            }
            next($userTagModel);
        }
        return $booksSelected;
    }

    /**
     * @param       array $books
     * @param       UserModel $userModel
     * @Brief       Retourne un tableau de livres en fonction de la profession d'utilisateur renseigné lors de la création de son compte.
     * @Details     Cette méthode récupère le modèle de la profession de l'utilisateur grâçe à la méthode getUserProfessionModel().
     *              La profession d'un utilisateur est rattachée à des tags qui lui correspond le plus.
     *              Lorsque l'utilisateur choisit sa profession, les livres suggérés pour l'utilisateur contiennent ces mêmes tags.
     *              Un tableau de livre est ensuite crée et retourné.
     * @return      array
     */
    public function userProfession(array $books, UserModel $userModel){
        $booksSelected = array();
        $userProfessionModel = $userModel->getUserProfessionModel();
        foreach ($userProfessionModel as $userProfession){
            foreach ($books as $book){
                if(in_array($userProfession,$book->getTags())){
                    array_push($booksSelected, $book);
                }

            }
        }
        return $booksSelected;
    }

    /**
     * @param       array $books
     * @param       UserModel $userModel
     * @Brief       Retourne un tableau de livres en fonction de la tranche d'âge de l'utilisateur renseigné lors de la création de son compte.
     * @Details     Cette méthode récupère le modèle de tranche d'âge de l'utilisateur grâçe à la méthode getUserAgeRangeModel().
     *              Le tableau de livre passé en paramètre est ensuite filtré en ne gardant que les livres dont la
     *              tranche d'âge respecte le model de tranche d'âge.
     *              Un tableau de livre récupéré à partir de la méthode précédente est retourné.
     * @return array
     */
    public function userAgeRange(array $books, UserModel $userModel){
        $booksSelected = array();
        $userAgeRangeModel = $userModel->getUserAgeRangeModel();
        foreach ($books as $book){
            if($book->getAgeRange() == $userAgeRangeModel)
                array_push($booksSelected, $book);
        }
        return $booksSelected;
    }
}
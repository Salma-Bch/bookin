<?php

/**
 * Class        UserAlgorithm
 * @File        UserAlgorithm.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion à partir du contenu acheté et aimé par le client.
 * @Details     Suggère des livres en fonction du contenu acheté et aimé par le client.
 */
namespace controller;


use model\Client;

class UserAlgorithm {
    private UserModel $userModel;
    private array $books;

    public function __construct(array $books, Client $client) {
        $this->books = $books;
        $this->userModel = new UserModel($client);
    }

    public function suggest(int $nbrOfBooks):array{
        if($nbrOfBooks > 0) {
            $booksTagBased = $this->userLikedTags($this->books, $this->userModel);
            var_dump($booksTagBased);
            $booksCategoryBased = $this->userLikedCategory($booksTagBased, $this->userModel);
            //$booksProfessionBased = $this->userProfession($booksCategoryBased,$this->userModel);
            //$booksAgeRangeBased = $this->userAgeRange($booksProfessionBased,$this->userModel);
            //shuffle($booksAgeRangeBased);
            var_dump($booksCategoryBased);
            for ($i = 0; $i < count($booksCategoryBased) - $nbrOfBooks; $i++) {
                array_pop($booksCategoryBased);
            }

            return $booksCategoryBased;
        }
        return array();
    }

    //OK
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

    //OK
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

    //A revoir
    public function userProfession(array $books, UserModel $userModel){
        $booksSelected = array();
        $userProfessionModel = $userModel->getUserProfessionModel();

        foreach ($userProfessionModel as $userProfession){
            if($userProfession != 0){
                foreach ($books as $book){
                    if($book->getTags() == key($userProfessionModel))
                        array_push($booksSelected, $book);
                }
            }
            next($userProfessionModel);
        }
        return $booksSelected;
    }

    //OK
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
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
            foreach ($books as $book){
                if(in_array($userProfession,$book->getTags())){
                    array_push($booksSelected, $book);
                }

            }
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
<?php


namespace controller;


use model\Client;

class UserAlgorithm {
    private UserModel $userModel;
    private array $books;

    public function __construct(array $books, Client $client) {
        $this->books = $books;
        $this->userModel = new UserModel($client);
    }

    public function suggest():array{
        $books = $this->userLikedCategory($this->books, $this->userModel);
        return $books;
    }

    public function userLikedCategory(array $books, UserModel $userModel){
        $booksSelected = array();
        $userCategoryModel = $userModel->getUserCategoryModel();

        foreach ($userCategoryModel as $userCategory) {
            if ($userCategory != 0) {
                foreach ($books as $book) {
                    if ($book->getCategoryName() == key($userCategoryModel))
                        array_push($booksSelected, $book);
                }
                next($userCategoryModel);
            }
        }
        $booksSelected = array_merge($booksSelected, $this->userLikedTags($booksSelected, $userModel));
        return $booksSelected;
    }

    //A revoir
    public function userLikedTags(array $books, UserModel $userModel){
        $booksSelected = array();
        $userTagModel = $userModel->getUserTagModel();

        foreach ($userTagModel as $userTag){
            if($userTag != 0){
                foreach ($books as $book){
                    if($book->getTags() == key($userTagModel))
                        array_push($booksSelected, $book);
                }
                next($userTagModel);
            }
        }
        $booksSelected = array_merge($booksSelected, $this->userProfession($booksSelected, $userModel));
        return $booksSelected;
    }

    //A revoir
    public function userProfession(array $books, UserModel $userModel){
        $booksSelected = array();
        $userProfessionModel = $userModel->getUserProfessionModel();

            foreach ($books as $book) {
                if ($book->getProfession() == key($userProfessionModel))
                    array_push($booksSelected, $book);
            }
            next($userProfessionModel);

        $booksSelected = array_merge($booksSelected, $this->userAgeRange($booksSelected, $userModel));
        return $booksSelected;
    }

    public function userAgeRange(array $books, UserModel $userModel){
        $booksSelected = array();
        $userAgeRangeModel = $userModel->getUserAgeRangeModel();

        foreach ($userAgeRangeModel as $userAgeRange){
            if($userAgeRange != 0){
                foreach ($books as $book){
                    if($book->getAgeRange() == key($userAgeRangeModel))
                        array_push($booksSelected, $book);
                }
            }
        }
        return $booksSelected;
    }
}
<?php

namespace controller;

use model\Client;
use utility\Math;

class ContentModel {
    private ClientHandler $suggestionHandler;
    private Client $client;

    /**
     * ContentModel constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->suggestionHandler = new ClientHandler($client);
    }

    /**
     * Retourne la catégorie modèle d'un client.
     *
     * @return array
     */
    public function getCategoryModel():array{
        $somme = 0;
        $buysBookCategories = $this->suggestionHandler->getBuysBooksCategories(); // Buys books
        $likedBookCategories = $this->suggestionHandler->getLikedBooksCategories(); // Liked books

        $categoriesName = array();
        $csvFile = fopen("./ressources/bd/db_category.csv","r");
        while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
            array_push($categoriesName, utf8_encode($lineCsv[0]));
        }

        $categories = array();

        foreach ($categoriesName as $categoryName){
            $categories[$categoryName] =0;
        }

        foreach ($buysBookCategories as $buysBookCategory){
            $categories[$buysBookCategory]++ ;
            $somme++;
        }

        foreach ($likedBookCategories as $likedBookCategory){
            $categories[$likedBookCategory]++ ;
            $somme++;
        }

        if($somme == 0) $somme = 1;

        // Fait un pourcentage avec le contenu du tableau.
        foreach ($categoriesName as $categoryName){
            $categories[$categoryName] /=$somme;
        }
        return $categories;
    }

    /**
     * Retourne la tranche d'âge modèle d'un client.
     *
     * @return array
     */
    public function getAgeRangeModel(){
        $buysBooks = $this->suggestionHandler->getBuysBooks(); // Buys books
        $likedBooks = $this->suggestionHandler->getLikedBooks(); // Liked books
        $somme = 0;
        $ageRanges = array("Enfants"=>0,"Adolescents"=>0,"Adultes"=>0,"Ainés"=>0);

        foreach ($buysBooks as $buysBook){
            $ageRanges[$buysBook->getAgeRange()]++;
            $somme++;
        }

        foreach ($likedBooks as $likedBook){
            $ageRanges[$likedBook->getAgeRange()]++;
            $somme++;
        }

        // Fait un pourcentage avec le contenu du tableau.
        $ageRanges['Enfants'] /=$somme;
        $ageRanges['Adolescents'] /=$somme;
        $ageRanges['Adultes'] /=$somme;
        $ageRanges['Ainés'] /=$somme;

        return $ageRanges;
    }

    /**
     * Retourne le prix modèle d'un client.
     *
     * @return array
     */
    public function getPriceModel():float{
        $buysBooksPrices = $this->suggestionHandler->getBuysBooksPrices(); // Buys books
        $likedBooksPrices = $this->suggestionHandler->getLikedBooksPrices(); // Liked books
        $books = array();

        foreach ($buysBooksPrices as $buysBooksPrice){
            array_push($books, $buysBooksPrice);
        }

        foreach ($likedBooksPrices as $likedBooksPrice){
            array_push($books, $likedBooksPrice);
        }

        //Si le client a acheté au moin 1 livre
        if(count($books)>=1 && Math::getStandardDeviation($books)<30) {
            return Math::getAverage($books);
        }
        else
            return -1;
    }

    /**
     * Retourne le nombre de page modèle d'un client.
     *
     * @return array
     */
    public function getBookSizeModel():array{
        $somme = 0;
        $buysBooksSizes = $this->suggestionHandler->getBuysBooksSizes(); // Buys books
        $likedBooksSizes = $this->suggestionHandler->getLikedBooksSizes(); // Liked books
        $booksSizes = array("court"=>0,"moyen"=>0,"long"=>0);

        foreach($buysBooksSizes as $buysBooksSize) {
            $booksSizes[$buysBooksSize]++;
            $somme++;
        }

        foreach($likedBooksSizes as $likedBooksSize) {
            $booksSizes[$likedBooksSize]++;
            $somme++;
        }

        // Fait un pourcentage avec le contenu du tableau.
        $booksSizes['court'] /=$somme;
        $booksSizes['moyen'] /=$somme;
        $booksSizes['long'] /=$somme;

        return $booksSizes;
    }

    /**
     * Retourne le nombre de page modèle d'un client.
     *
     * @return array
     */
    public function getTagsModel():array{
        $buysBooksTags = $this->suggestionHandler->getBuysBooksTags(); // Buys books
        $likedBooksTags = $this->suggestionHandler->getLikedBooksTags(); // Liked books
        $tags = array_merge($buysBooksTags, $likedBooksTags);
        $somme = 0;
        $tagsToReturn = array();

        $tagsName = array();
        $csvFile = fopen("./ressources/bd/db_tag.csv","r");
        while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
            array_push($tagsName, utf8_encode($lineCsv[0]));
        }

        foreach ($tagsName as $tagName){
            $tagsToReturn[$tagName] = 0;
        }


        foreach($tags as $tag) {
            $tagsToReturn[$tag]++;
            $somme++ ;
        }

        foreach ($tagsName as $tagName){
            $tagsToReturn[$tagName] /= $somme;
        }
        //var_dump($tagsToReturn);
        return $tagsToReturn;
    }

}
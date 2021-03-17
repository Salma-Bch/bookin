<?php

/**
 * Class        ContentModel
 * @File        ContentModel.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Création d'un modèle de contenu du client.
 * @Details     Cette classe créee des modèles pour la catégorie, la tranche d'âge, le prix, le nombre de pages, et les tags des livres aimés et achetés.
 */

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
     * @Brief       Retourne le modèle de catégorie d'un client.
     * @Details     Cette méthode récupère les catégories des livres achetés et aimés par un client et les rassemble dans un tableau.
     *              Elle effectue un pourcentage pour chacune d'entre-elles puis retourne un tableau de
     *              pourcentage avec pour clé le nom de la catégorie.
     * @return      array
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
     * @Brief       Retourne le modèle de tranche d'âge d'un client.
     * @Details     Cette méthode récupère les tranches d'âge des livres achetés et aimés, puis les rassemble dans un tableau.
     *              Elle effectue un pourcentage pour chacune d'entre-elles puis retourne un tableau de
     *              pourcentage avec pour clé la tranche d'âge.
     * @return      array
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
        if($somme==0) $somme=1;
        // Fait un pourcentage avec le contenu du tableau.
        $ageRanges['Enfants'] /=$somme;
        $ageRanges['Adolescents'] /=$somme;
        $ageRanges['Adultes'] /=$somme;
        $ageRanges['Ainés'] /=$somme;

        return $ageRanges;
    }

    /**
     * @Brief       Retourne le modèle de prix d'un client.
     * @Details     Cette méthode récupère le prix des différents livres achetés et aimés par le client, puis les rassemble dans un tableau.
     *              Elle effectue ensuite la moyenne de ses prix puis la retourne.
     * @return      float
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
     * @Brief       Retourne le modèle du nombre de pages des livres d'un client.
     * @Details     Cette méthode récupère le nombre de pages des différents livres achetés et aimés, puis les rassemble dans un tableau.
     *              Elle effectue un pourcentage pour chacun d'entre-eux puis retourne un tableau de
     *              pourcentage avec pour clé la taille d'un livre.
     *              Court : Infèrieur ou égal à 100
     *              Moyen : Compris entre 101 et 200
     *              Long : Supérieur à 200
     * @return      array
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
        if($somme==0) $somme=1;

        // Fait un pourcentage avec le contenu du tableau.
        $booksSizes['court'] /=$somme;
        $booksSizes['moyen'] /=$somme;
        $booksSizes['long'] /=$somme;

        return $booksSizes;
    }

    /**
     * @Brief       Retourne le modèle de tag d'un client.
     * @Details     Cette méthode récupère les tags des différents livres achetés et aimés, puis les rassemble dans un tableau.
     *              Elle effectue un pourcentage pour chacun d'entre-eux puis retourne un tableau de
     *              pourcentage avec pour clé le nom du tag.
     * @return      array
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
        if($somme==0) $somme=1;

        foreach ($tagsName as $tagName){
            $tagsToReturn[$tagName] /= $somme;
        }
        return $tagsToReturn;
    }

}
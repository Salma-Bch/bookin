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

        $categories = array("Actualité"=>0,"Amour"=>0,"Art"=>0,"Bande dessinée"=>0,"Bien-être"=>0,"Cuisine"=>0,
                                "Culture"=>0,"Éducation"=>0,"Histoire"=>0,"Loisir"=>0,"Policier"=>0,"Psychologie"=>0,
                                    "Santé"=>0,"Science"=>0,"Science-fiction"=>0,"Vie pratique"=>0);

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
        $categories['Actualité'] /=$somme;
        $categories['Amour'] /=$somme;
        $categories['Art'] /=$somme;
        $categories['Bande dessinée'] /=$somme;
        $categories['Bien-être'] /=$somme;
        $categories['Cuisine'] /=$somme;
        $categories['Culture'] /=$somme;
        $categories['Éducation'] /=$somme;
        $categories['Histoire'] /=$somme;
        $categories['Loisir'] /=$somme;
        $categories['Policier'] /=$somme;
        $categories['Psychologie'] /=$somme;
        $categories['Santé'] /=$somme;
        $categories['Science'] /=$somme;
        $categories['Science-fiction'] /=$somme;
        $categories['Vie pratique'] /=$somme;

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

        if(count($books)>=1 && Math::getStandardDeviation($books)<30) {
            echo "Moyenne : ".Math::getAverage($books);
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
        $tags = array();

        foreach($buysBooksTags as $buysBooksTag) {
            array_push($tags, $buysBooksTag);
        }

        foreach($likedBooksTags as $likedBooksTag) {
            array_push($tags, $likedBooksTag);
        }

        //////////// A FINIIIIIIIIIIIIIIIIIIIIR ////////////
        return $tags;
    }

}
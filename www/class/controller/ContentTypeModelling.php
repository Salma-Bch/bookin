<?php

namespace controller;

use model\Client;
use utility\Math;

class ContentTypeModelling
{
    private ClientHandler $clientHandler;

    /**
     * ContentTypeModelling constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->clientHandler = new ClientHandler($client);
    }

    /**
     * Retourne la catégorie modèle d'un client.
     *
     * @return array
     */
    public function getCategoryModel():array{
        // Se base sur les catégories aimées (LIKES) et les livré aimés par le client (EVALUATES).

        $somme = 0;

        $likedCategories = $this->clientHandler->getLikedCategories(); // Compte pour deux
        $likedBookCategories = $this->clientHandler->getLikedBooksCategories(); // Compte pour un

        $categories = array("Actualité"=>0,"Amour"=>0,"Art"=>0,"Bande dessinée"=>0,"Bien-être"=>0,"Cuisine"=>0,
                                "Culture"=>0,"Éducation"=>0,"Histoire"=>0,"Loisir"=>0,"Policier"=>0,"Psychologie"=>0,
                                    "Santé"=>0,"Science"=>0,"Science-fiction"=>0,"Vie pratique"=>0);

        foreach ($likedCategories as $likedCategory){
            $categories[$likedCategory] += 2 ;
            $somme+=2;
        }
        foreach ($likedBookCategories as $likedBookCategory){
            $categories[$likedBookCategory]++ ;
            $somme++;
        }

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
        $books = $this->clientHandler->getBuysBooks();
        $somme = 0;
        $ageRanges = array("Enfants"=>0,"Adolescents"=>0,"Adultes"=>0,"Ainés"=>0);

        foreach ($books as $book){
            $ageRanges[$book->clientHandler->getAgeRange()]++;
            $somme++;
        }

        $ageRanges[$this->clientHandler->getAgeRange()] += 2; // Compte pour deux
        $somme+=2;

        // Fait un pourcentage avec le contenu du tableau.
        $ageRanges['Enfants'] /=$somme;
        $ageRanges['Adolescents'] /=$somme;
        $ageRanges['Adultes'] /=$somme;
        $ageRanges['Ainés'] /=$somme;
    }

    /**
     * Retourne le prix modèle d'un client.
     *
     * @return array
     */
    public function getPriceModel():float{
        $prices = $this->clientHandler->getBuysBooksPrices();
        if(count($prices)>=1 && Math::getStandardDeviation($prices)<30) {
            echo "Moyenne : ".Math::getAverage($prices);
            return Math::getAverage($prices);
        }
        else
            return -1;
    }

    /**
     * Retourne le nombre de page modèle d'un client.
     *
     * @return array
     */
    public function getNumberOfPagesModel():array{
        $buysBooksSizes = $this->clientHandler->getBuysBooksSizes(); // Compte pour un
        $likedBooksSizes = $this->clientHandler->getLikedBooksSizes(); // Compte pour un
        $booksSizes = array();

        foreach($buysBooksSizes as $buysBooksSize)
            array_push($booksSizes, $buysBooksSize);
        foreach($likedBooksSizes as $likedBooksSize)
            array_push($booksSizes, $likedBooksSize);

        // A refaire
        foreach($booksSizes as $numberOfPage)
            if(count($numberOfPage)>=1 && Math::getStandardDeviation($numberOfPage)<30) {
                echo "Moyenne : ".Math::getAverage($numberOfPage);
                return Math::getAverage($numberOfPage);
            }
            else
                return -1;
    }

}
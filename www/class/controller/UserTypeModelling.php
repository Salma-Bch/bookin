<?php

namespace controller;

use model\Client;

class UserTypeModelling
{
    private ClientHandler $suggestionHandler;
    private Client $client;

    /**
     * ContentTypeModelling constructor.
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
    public function getUserCategoryModel():array{
        $somme = 0;
        $likedCategories = $this->suggestionHandler->getLikedCategories(); // Liked categories

        $categories = array("Actualité"=>0,"Amour"=>0,"Art"=>0,"Bande dessinée"=>0,"Bien-être"=>0,"Cuisine"=>0,
            "Culture"=>0,"Éducation"=>0,"Histoire"=>0,"Loisir"=>0,"Policier"=>0,"Psychologie"=>0,
            "Santé"=>0,"Science"=>0,"Science-fiction"=>0,"Vie pratique"=>0);

        foreach ($likedCategories as $likedCategory){
            $categories[$likedCategory] += 2 ;
            $somme+=2;
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
     * Retourne le tag modèle d'un client.
     *
     * @return array
     */
    public function getUserTagModel():array{
        $tags = $this->client->getTags();
        return $tags;
    }

    /**
     * Retourne la profession modèle d'un client.
     *
     * @return array
     */
    public function getUserProfessionModel():String{
        $profession = $this->client->getProfession();
        return $profession;
    }

    /**
     * Retourne la tranche d'âge modèle d'un client.
     *
     * @return array
     */
    public function getUserAgeRangeModel(){
        $somme = 0;
        $ageRanges = array("Enfants"=>0,"Adolescents"=>0,"Adultes"=>0,"Ainés"=>0);

        $ageRanges[$this->client->getAgeRange()] += 2; // Compte pour deux
        $somme+=2;

        // Fait un pourcentage avec le contenu du tableau.
        $ageRanges['Enfants'] /=$somme;
        $ageRanges['Adolescents'] /=$somme;
        $ageRanges['Adultes'] /=$somme;
        $ageRanges['Ainés'] /=$somme;

        return $ageRanges;
    }

}
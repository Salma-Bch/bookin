<?php

/**

 * Class        UserModel
 * @File        UserModel.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Création d'un modèle de l'utilisateur
 * @Details     Cette classe crée un modèle pour chacune des spécificités d'un utilisiteur
 */
namespace controller;

use model\Client;

class UserModel
{
    private ClientHandler $clientHandler;
    private Client $client;

    /**
     * ContentModel constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->clientHandler = new ClientHandler($client);
    }

    /**
     * @Brief       Retourne le modèle de catégorie choisit par un client.
     * @Details     Cette méthode récupère la catégorie des livres choisit lorsque le client crée son compte et les rassemble dans un tableau.
     *              Elle effectue un pourcentage avec le contenu du tableau et le retourne.
     * @return      array
     */
    public function getUserCategoryModel():array{
        $somme = 0;
        $likedCategories = $this->clientHandler->getLikedCategories(); // Liked categories

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
     * @Brief       Retourne le modèle de tag choisit par un client.
     * @Details     Cette méthode récupère les tags des livres choisit lorsque le client crée son compte et les retourne dans un tableau.
     * @return      array
     */
    public function getUserTagModel():array{
        $tags = $this->client->getTags();
        return $tags;
    }

    /**
     * @Brief       Retourne le modèle de la profession choisit par un client.
     * @Details     Cette méthode récupère la profession choisit par le client lorsqu'il crée son compte et la retourne.
     * @return      String
     */
    public function getUserProfessionModel():String{
        $profession = $this->client->getProfession();
        return $profession;
    }

    /**
     * @Brief       Retourne le modèle de la tranche d'âge d'un client.
     * @Details     Cette méthode récupère l'âge du client et l'affecte à une tranche d'âge.
     *              Elle effectue un pourcentage afin de retourner des livres se rapprochant le plus de la catégorie d'âge du client,
     *              puis les retourne dans un tableau.
     * @return      array
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
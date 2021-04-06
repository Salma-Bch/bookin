<?php

/**
 * Class        UserModel
 * @File        UserModel.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
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
     * @Details     Cette méthode récupère la catégorie choisit lorsque le client crée son compte et les rassemble dans un tableau.
     *              Elle effectue un pourcentage avec le contenu du tableau et le retourne.
     * @return      array
     */
    public function getUserCategoryModel():array{
        $somme = 0;
        $likedCategories = $this->clientHandler->getLikedCategories(); // Liked categories

        $categoriesName = array();
        $csvFile = fopen("./ressources/bd/db_category.csv","r");
        while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
            array_push($categoriesName, utf8_encode($lineCsv[0]));
        }

        $categories = array();

        foreach ($categoriesName as $categoryName){
            $categories[$categoryName] = 0;
        }

        foreach ($likedCategories as $likedCategory){
            $categories[$likedCategory] += 2 ;
            $somme+=2;
        }

        if($somme == 0) $somme = 1;

        // Fait un pourcentage avec le contenu du tableau.
        foreach ($categoriesName as $categoryName){
            $categories[$categoryName] /=$somme;
        }

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
    public function getUserAgeRangeModel():String{
        return $this->client->getAgeRange();
    }

}
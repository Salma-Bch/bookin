<?php

/**
 * Class        Suggestion
 * @File        Suggestion.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        17/03/2021
 * @Brief       Algorithme de suggestion de livres
 * @Details     Rassemble les 4 sous-algorithmes de suggestion dans un algorithme principal
 */
namespace controller;

use dao\DAOFactory;
use model\Client;

/**
 * Class Suggestion
 * @package controller
 */
class Suggestion {

    private Client $client;
    private array $books;

    /**
     * Suggestion constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $daoFactory = DAOFactory::getInstance();
        $bookDao = $daoFactory->getBookDao();
        $this->books = $bookDao->getAll();
        $this->client = $client;
    }

    /**
     * @Brief       Récupère les livres retounés par les sous-algorithmes.
     * @Details     Cette méthode appelle les différents sous-algorithmes et retourne un tableau des livres suggérés.
     * @return      array
     */
    public function suggest():array{
        $contentAlgorithm = new ContentAlgorithm($this->books, $this->client);
        $popularAlgorithm = new PopularAlgorithm();

        $booksToDisplay = $contentAlgorithm->suggest();
        $popularBooks = $popularAlgorithm->suggest(2);


        //Ajout des livres populaire s'il ne sont pas déja suggeré.
        foreach ($popularBooks as $popularBook){
            if(!in_array($popularBook,$booksToDisplay))
                array_push($booksToDisplay,$popularBook);
        }
        $randomAlgorithm = new RandomAlgorithm(array_diff($this->books,$booksToDisplay));
        $randomBooks = $randomAlgorithm->suggest(2);
        $booksToDisplay = array_merge($booksToDisplay,$randomBooks);

        $userAlgorithme = new UserAlgorithm(array_diff($this->books,$booksToDisplay),$this->client);
        $userBooks = $userAlgorithme->suggest(18-count($booksToDisplay));
        $booksToDisplay = array_merge($booksToDisplay,$userBooks);
        shuffle($booksToDisplay);
        $sizeTab = count($booksToDisplay);
        for ($i = 0; $i < $sizeTab - 18; $i++) {
            array_pop($booksToDisplay);
        }
        return $booksToDisplay;
    }



}
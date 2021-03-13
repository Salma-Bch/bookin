<?php

namespace controller;

use model\Client;

class PopularAlgorithm {

    private $books;

    /**
     * PopularAlgorithm constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->suggestionHandler = new ClientHandler($client);
    }

    /**
     * Retourne les livres les plus achetés par les clients.
     *
     * @return array
     */
    public function getMostPurchasedBooks():array{
        /////// A REVOIR //////
        $somme = 0;
        $buysBooks = $this->suggestionHandler->getBuysBooks(); // Buys books

        foreach ($buysBooks as $buysBook){
            $buysBooks[$buysBook]++;
            $somme++;
        }
        foreach ($buysBooks as $buysBook){
            $buysBooks[$buysBook] /=$somme;
        }
        return $buysBooks;
    }

}
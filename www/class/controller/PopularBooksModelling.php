<?php

namespace controller;

use model\Client;

class PopularBooksModelling {
    private SuggestionHandler $suggestionHandler;
    private Client $client;

    /**
     * PopularBooksModelling constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->suggestionHandler = new SuggestionHandler($client);
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
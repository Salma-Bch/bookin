<?php

namespace controller;

use dao\DAOFactory;
use model\Client;
use utility\Format;

class ClientHandler {
    private Client $client;

    /**
     * Constructeur de la classe ClientHandler.php
     *
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    ///////////////// CATEGORIES /////////////////

    /**
     * Retourne les catégories aimées par le client.
     *
     * @return array
     */
    public function getLikedCategories():array{
        $daoFactory = DAOFactory::getInstance();
        $likesDao = $daoFactory->getLikesDao();
        $likes = $likesDao->find(Format::getFormatId(8,$this->client->getClientId()),null);
        $categoriesReturned = array();
        foreach ($likes as $like){
            array_push($categoriesReturned, $like->getCategoryName());
        }
        return $categoriesReturned;
    }

    ///////////////// LIKED BOOKS /////////////////

    /**
     * Retourne les livres aimé par le client.
     *
     * @return array
     */
    public function getLikedBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $evaluatesDao = $daoFactory->getEvaluatesDao();
        $evaluates = $evaluatesDao->find(null, Format::getFormatId(8,$this->client->getClientId()));
        $booksReturned = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($evaluates as $evaluation){
            if($evaluation->getSatisfied()) {
                $book = $bookDao->find(Format::getFormatId(8, $evaluation->getBookId()));
                array_push($booksReturned, $book);
            }
        }
        return $booksReturned;
    }

    /**
     * Retourne les catégories des livres aimés par le client.
     *
     * @return array
     */
    public function getLikedBooksCategories():array{
        $categories = array();
        $booksLiked = $this->getLikedBooks();
        foreach ($booksLiked as $book){
            array_push($categories, $book->getCategoryName());
        }
        return $categories;
    }

    /**
     * Retourne les prix des livres aimés par le client.
     *
     * @return array
     */
    public function getLikedBooksPrices():array{
        $prices = array();
        $likedBooks = $this->getLikedBooks();
        foreach ($likedBooks as $likedBook) {
            array_push($prices, $likedBook->getPrice());
        }
        return $prices;
    }

    /**
     * Retourne le nombre de page des livres aimés par le client.
     *
     * @return array
     */
    public function getLikedBooksSizes():array{
        $booksSizes = array();
        $booksLiked = $this->getLikedBooks();
        foreach ($booksLiked as $book){
            array_push($booksSizes, $book->getBookSize());
        }
        return $booksSizes;
    }

    /**
     * Retourne les tags des livres aimés par le client.
     *
     * @return array
     */
    public function getLikedBooksTags():array{
        $tags = array();
        $booksLiked = $this->getLikedBooks();
        foreach ($booksLiked as $book){
            $tags = array_merge($tags, $book->getTags());
        }
        return $tags;
    }

    ///////////////// BUYS BOOKS /////////////////

    /**
     * Retourne les livres achetés par le client.
     *
     * @return array
     */
    public function getBuysBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $purchaseDao = $daoFactory->getPurchaseDao();
        $purchases = $purchaseDao->getClientPurchases(Format::getFormatId(8,$this->client->getClientId()));
        $booksReturned = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($purchases as $purchase){
            $book = $bookDao->find(Format::getFormatId(8,$purchase->getBookId()));
            array_push($booksReturned,$book);
        }
        return $booksReturned;
    }

    /**
     * Retourne les catégories des livres aimés par le client.
     *
     * @return array
     */
    public function getBuysBooksCategories():array{
        $categories = array();
        $buysBooks = $this->getBuysBooks();
        foreach ($buysBooks as $book){
            array_push($categories, $book->getCategoryName());
        }
        return $categories;
    }

    /**
     * Retourne les prix des livres achetés par le client.
     *
     * @return array
     */
    public function getBuysBooksPrices():array{
        $prices = array();
        $buysBooks = $this->getBuysBooks();
        foreach ($buysBooks as $book) {
            array_push($prices, $book->getPrice());
        }
        return $prices;
    }

    /**
     * Retourne le nombre de page des livres achetés par le client.
     *
     * @return array
     */
    public function getBuysBooksSizes():array {
        $booksSizes = array();
        $buysBooks = $this->getBuysBooks();
        foreach ($buysBooks as $book) {
            array_push($booksSizes, $book->getBookSize());
        }
        return $booksSizes;
    }

    /**
     * Retourne les tags des livres achetés par le client.
     *
     * @return array
     */
    public function getBuysBooksTags():array{
        $tags = array();
        $buysBooks = $this->getBuysBooks();
        foreach ($buysBooks as $book) {
            $tags = array_merge($tags, $book->getTags());
        }
        return $tags;
    }

}
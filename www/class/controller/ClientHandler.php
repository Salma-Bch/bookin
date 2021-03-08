<?php


namespace controller;


use dao\DAOFactory;
use model\Client;

class ClientHandler
{
    private Client $client;

    /**
     * ClientHandler constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retourne les catégories aimées par le client.
     *
     * @return array
     */
    public function getLikedCategories():array{
        $daoFactory = DAOFactory::getInstance();
        $likesDao = $daoFactory->getLikesDao();
        $likes = $likesDao->find($this->client->getClientId(),null);
        $categoriesReturned = array();
        foreach ($likes as $like){
            array_push($categoriesReturned, $like);
        }
        return $categoriesReturned;
    }

    /**
     * Retourne les livres avec une évaluation positive du client.
     *
     * @return array
     */
    public function getLikedBooks():array{
        $daoFactory = DAOFactory::getInstance();
        $evaluatesDao = $daoFactory->getEvaluatesDao();
        $evaluates = $evaluatesDao->find(null, $this->client->getClientId());
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
            array_push($categories, $book->getCategory());
        }
        return $categories;
    }

    /**
     * Retourne les livres achetés d'un client.
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
     * Retourne les prix des livres achetés par un client.
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
     * Retourne le nombre de page des livres achetés par un client.
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
     * Retourne le nombre de page des livres ayant une évaluation positive du client.
     *
     * @return array
     */
    public function getLikedBooksSizes():array{
        $booksSizes = array();
        $booksLiked = $this->getLikedBooks();
        foreach ($booksLiked as $book){
            array_push($booksSizes, $book->getNumberPages());
        }
        return $booksSizes;
    }

}
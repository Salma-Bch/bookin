<?php

 /**
 * Class        ClientHandler
 * @File        ClientHandler.php
 * @package     controller
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     3.0
 * @Date        17/03/2021
 * @Brief       Gestionnaire du client.
 * @Details     Permet de récupérer toutes les intéractions du client avec l'application web.
 */

namespace controller;

use dao\DAOFactory;
use model\Client;
use utility\Format;

class ClientHandler {

     /**
     * @var Client
     */
    private Client $client;
    private array $likedBooks;
    private array $buysBooks;

     /**
     * ClientHandler constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->likedBooks = $this->getLikedBooksDB();
        $this->buysBooks = $this->getBuysBooksDB();
    }

    ///////////////// METHOD FOR LIKED CATEGORIES /////////////////

     /**
     * @Brief       Retourne les catégories aimées par le client.
     * @Details     La méthode find() de likesDao permet de récupérer les catégories aimées par le client à partir de la base de données.
     *              Les noms de celle-ci sont ensuite récupérés puis placer dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
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

    ///////////////// METHODS FOR LIKED BOOKS /////////////////

     /**
     * @Brief       Retourne les livres aimé par le client.
     * @Details     La méthode find() de evaluatesDao permet de récupérer les évaluation du client à partir de la base de données.
     *              La méthode getSatisfied() permet ensuite de récupérer l'avis du client sur le livre.
     *              Si son avis est positif, celle-ci utilise la méthode find() de booksDao afin de trouver les livres correspondant.
     *              Ces livres sont ensuite placé dans un tableau qui sera retourné.
     * @return      array
     */
    public function getLikedBooksDB():array{
        $daoFactory = DAOFactory::getInstance();
        $evaluatesDao = $daoFactory->getEvaluatesDao();
        $evaluates = $evaluatesDao->find(null, Format::getFormatId(8,$this->client->getClientId()));
        $booksId = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($evaluates as $evaluation){
            if($evaluation->getSatisfied()) {
                array_push($booksId,$evaluation->getBookId());
            }
        }
        return $bookDao->findIn($booksId);;
    }

    /**
     * @return array
     */
    public function getLikedBooks(): array
    {
        return $this->likedBooks;
    }

    /**
     * @return array
     */
    public function getBuysBooks(): array
    {
        return $this->buysBooks;
    }



    /**
     * @Brief       Retourne les catégories des livres aimés par le client.
     * @Details     La méthode getLikedBooks() permet de récupérer les livres avec une évaluation positives du client.
     *              Le nom de la catégorie de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getLikedBooksCategories():array{
        $categories = array();
        $booksLiked = $this->likedBooks;
        foreach ($booksLiked as $book){
            array_push($categories, $book->getCategoryName());
        }
        return $categories;
    }

    /**
     * @Brief       Retourne les prix des livres aimés par le client.
     * @Details     La méthode getLikedBooks() permet de récupérer les livres avec une évaluation positives du client.
     *              Le prix de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getLikedBooksPrices():array{
        $prices = array();
        $likedBooks = $this->likedBooks;
        foreach ($likedBooks as $likedBook) {
            array_push($prices, $likedBook->getPrice());
        }
        return $prices;
    }

    /**
     * @Brief       Retourne le nombre de page des livres aimés par le client.
     * @Details     La méthode getLikedBooks() permet de récupérer les livres avec une évaluation positives du client.
     *              Le nombre de page de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getLikedBooksSizes():array{
        $booksSizes = array();
        $booksLiked = $this->likedBooks;
        foreach ($booksLiked as $book){
            array_push($booksSizes, $book->getBookSize());
        }
        return $booksSizes;
    }

    /**
     * @Brief       Retourne les tags des livres aimés par le client.
     * @Details     La méthode getLikedBooks() permet de récupérer les livres avec un évaluation positives du client.
     *              Les tags de chacun de ses livres sont placés dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getLikedBooksTags():array{
        $tags = array();
        $booksLiked = $this->likedBooks;
        foreach ($booksLiked as $book){
            $tags = array_merge($tags, $book->getTags());
        }
        return $tags;
    }

    ///////////////// METHODS FOR BUYS BOOKS /////////////////

    /**
     * @Brief       Retourne les livres achetés par le client.
     * @Details     La méthode find() de purchaseDao permet de récupérer les achats du client à partir de la base de données.
     *              La méthode find() de bookDao permet ensuite de trouver les livres correspondant puis les place dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getBuysBooksDB():array{
        $daoFactory = DAOFactory::getInstance();
        $purchaseDao = $daoFactory->getPurchaseDao();
        $purchases = $purchaseDao->getClientPurchases(Format::getFormatId(8,$this->client->getClientId()));
        $booksId = array();
        $bookDao = $daoFactory->getBookDao();
        foreach ($purchases as $purchase){
            array_push($booksId,$purchase->getBookId());
        }
        return $bookDao->findIn($booksId);
    }

    /**
     * @Brief       Retourne les catégories des livres aimés par le client.
     * @Details     La méthode getBuysBooks() permet de récupérer les livres achetés par le client.
     *              Le nom de la catégorie de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getBuysBooksCategories():array{
        $categories = array();
        $buysBooks = $this->buysBooks;
        foreach ($buysBooks as $book){
            array_push($categories, $book->getCategoryName());
        }
        return $categories;
    }

    /**
     * @Brief       Retourne les prix des livres achetés par le client.
     * @Details     La méthode getBuysBooks() permet de récupérer les livres achetés par le client.
     *              Le prix de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getBuysBooksPrices():array{
        $prices = array();
        $buysBooks = $this->buysBooks;
        foreach ($buysBooks as $book) {
            array_push($prices, $book->getPrice());
        }
        return $prices;
    }

    /**
     * @Brief       Retourne le nombre de page des livres achetés par le client.
     * @Details     La méthode getBuysBooks() permet de récupérer les livres achetés par le client.
     *              Le nombre de page de chacun de ses livres est placé dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getBuysBooksSizes():array {
        $booksSizes = array();
        $buysBooks = $this->buysBooks;
        foreach ($buysBooks as $book) {
            array_push($booksSizes, $book->getBookSize());
        }
        return $booksSizes;
    }

    /**
     * @Brief       Retourne les tags des livres achetés par le client.
     * @Details     La méthode getBuysBooks() permet de récupérer les livres achetés par le client.
     *              Les tags de chacun de ses livres sont placés dans un tableau.
     *              Ce tableau est ensuite retourné.
     * @return      array
     */
    public function getBuysBooksTags():array{
        $tags = array();
        $buysBooks = $this->buysBooks;
        foreach ($buysBooks as $book) {
            $tags = array_merge($tags, $book->getTags());
        }
        return $tags;
    }

}
<?php

use dao\DAOFactory;
include_once("./includeFiles.php");
$daoFactory = DAOFactory::getInstance();
$clientDao = $daoFactory->getClientDao();
$client = $clientDao->find("a@a.fr","Azerty96)");


 function testGetLikedCategories($client){

     $clientHandler = new \controller\ClientHandler($client);
     $result = $clientHandler->getLikedCategories();   //Tableau avec les catégories
     $resultExpected = array("Art","Bande dessinée","Education","Histoire","Psychologie");
     $difference = array_diff($resultExpected,$result);
     $difference2 = array_diff($result,$resultExpected);

     if(count($difference) == 0 && count($difference2)==0){
         echo "Test réussi, fonctionne comme attendu";
     }
     else{
         echo "Test échoué, ne fonctionne pas comme attendu";
     }
 }
//testGetLikedCategories($client);

function testGetLikedBooks($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getLikedBooks();   //Tableau avec les livres aimés
    $resultExpected = array("Actualité","Art","Bande dessinée","Education","Histoire","Psychologie");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);
    var_dump($result);
    var_dump($resultExpected);
   // var_dump($difference);
   // var_dump($difference2);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
testGetLikedBooks($client); //me retourne échoué alors que c'est correcte

function testGetLikedBooksCategories($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getLikedBooksCategories();   //Tableau avec les livres aimés
    $resultExpected = array("Art","Bande dessinée","Education","Histoire","Psychologie");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);
    var_dump($result);
    var_dump($resultExpected);
    //var_dump($difference);
   // var_dump($difference2);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetLikedBooksCategories($client);

function testGetLikedBooksPrices($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getLikedBooksPrices();   //Tableau avec les livres aimés
    $resultExpected = array("9","9","8","8","7");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);
    var_dump($result);
    var_dump($resultExpected);
    //var_dump($difference);
    // var_dump($difference2);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetLikedBooksPrices($client);

/*function testGetLikedBooks($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getLikedBooks();   //Tableau avec les catégories
    $resultExpected = array("moyen","moyen","moyen","moyen","long");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump(($resultExpected));

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
testGetLikedBooks($client);*/
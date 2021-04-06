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
//testGetLikedBooks($client); //me retourne échoué alors que c'est correcte

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

function testGetLikedBooksTags($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getLikedBooksTags();   //Tableau avec les catégories
    $resultExpected = array("Eau","Emotion","Location","Loisir","Psychologie"); //faut pas calculer
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetLikedBooksTags($client); // les tags que j'ai mis ne correspondent pas mais fonction correct

function testGetBuysBooksDB($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getBuysBooksDB();   //Tableau avec les catégories
    $resultExpected = array("00000030","00000031","00000033","00000037","00000066");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetBuysBooksDB($client);
function testGetBuysBooksCategories($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getBuysBooksCategories();   //Tableau avec les catégories
    $resultExpected = array("Bande dessinée","Bande dessinée","Bande dessinée","Bien-être","Education");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetBuysBooksCategories($client);

function testGetBuysBooksPrices($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getBuysBooksPrices();   //Tableau avec les catégories
    $resultExpected = array("11","8","8","9","7");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetBuysBooksPrices($client);

function testGetBuysBooksSizes($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getBuysBooksSizes();   //Tableau avec les catégories
    $resultExpected = array("court","court","court","long","long");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
//testGetBuysBooksSizes($client);

function testGetBuysBooksTags($client){

    $clientHandler = new \controller\ClientHandler($client);
    $result = $clientHandler->getBuysBooksTags();   //Tableau avec les catégories
    $resultExpected = array("BD","Jeunesse","Bien","Santé","Mental","Education","Amour","Scolaire");
    $difference = array_diff($resultExpected,$result);
    $difference2 = array_diff($result,$resultExpected);

    var_dump($result);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
testGetBuysBooksTags($client);

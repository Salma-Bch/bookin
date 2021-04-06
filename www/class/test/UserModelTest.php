<?php
use controller\ClientHandler;
use dao\DAOFactory;
include_once("./includeFiles.php");
$daoFactory = DAOFactory::getInstance();
$clientDao = $daoFactory->getClientDao();
$client = $clientDao->find("a@a.fr","Azerty96)");

function testGetUserCategoryModel($client){

    $clientHandler = new \controller\UserModel($client);
    $result = $clientHandler->getUserCategoryModel();   //Tableau avec les catégories
    $resultExpected = array("Bande dessinée","Bande dessinée","Bande dessinée","Bien-être","Education","Art","Bande dessinée","Education","Histoire","Psychologie");
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
//testGetUserCategoryModel($client);

function testGetUserTagModel($client){

    $clientHandler = new \controller\UserModel($client);
    $result = $clientHandler->getUserTagModel();   //Tableau avec les catégories
    $resultExpected = array("Eau","Emotion","Location","Loisir","Psychologie");
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
//testGetUserTagModel($client);

function testGetUserAgeRangeModel($client){

    $clientHandler = new \controller\UserModel($client);
    $result = $clientHandler->getUserAgeRangeModel();   //Tableau avec les catégories
    $resultExpected = array("Eau","Emotion","Location","Loisir","Psychologie");
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
//testGetUserAgeRangeModel($client);

function testGetUserProfessionModel($client){

    $clientHandler = new \controller\UserModel($client);
    $result = $clientHandler->getUserProfessionModel();   //Tableau avec les catégories
    $resultExpected = array("Eau","Emotion","Location","Loisir","Psychologie");
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
//testGetUserProfessionModel($client);
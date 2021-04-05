<?php

use controller\ClientHandler;
use dao\DAOFactory;
include_once("./includeFiles.php");
$daoFactory = DAOFactory::getInstance();
$clientDao = $daoFactory->getClientDao();
$client = $clientDao->find("a@a.fr","Azerty96)");

function testGetCategoryModel($client){

    $clientHandler = new \controller\ContentModel($client);
    $result = $clientHandler->getCategoryModel();   //Tableau avec les catégories
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
testGetCategoryModel($client);

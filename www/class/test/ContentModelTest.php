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
//testGetCategoryModel($client);

function testGetAgeRangeModel($client){

    $clientHandler = new \controller\ContentModel($client);
    $result = $clientHandler->getAgeRangeModel();   //Tableau avec les catégories
    $resultExpected = array("Enfants","Enfants","Enfants","Ainés","Ainés","Adultes","Adultes","Adultes","Adultes","Adolescents");
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
//testGetAgeRangeModel($client);

function testGetPriceModel($client){

    $clientHandler = new \controller\ContentModel($client);
    $result = $clientHandler->getPriceModel();   //Tableau avec les catégories
    $resultExpected = array("8.4");
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
//testGetPriceModel($client); fait bien la moyenne, juste erreur au niveau de array_diff


function testGetBookSizeModel($client){

    $clientHandler = new \controller\ContentModel($client);
    $result = $clientHandler->getBookSizeModel();   //Tableau avec les catégories
    $resultExpected = array("0.3","0.3","0.4");
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
//testGetBookSizeModel($client);

function testGetTagsModel($client){

    $clientHandler = new \controller\ContentModel($client);
    $result = $clientHandler->getTagsModel();   //Tableau avec les catégories
    $resultCompressed = array();
    $resultExpected = array("BD"=>0.16,"Jeunesse"=>0.16,"Bien"=>0.04,"Santé"=>0.04,"Mental"=>0.08,"Psychologie"=>0.04,"Education"=>0.08,
        "Amour"=>0.08,"Scolaire"=>0.08,"Histoire"=>0.04,"Guerre"=>0.04,"France"=>0.04,"Art"=>0.04,"Peinture"=>0.04,"Oeuvre"=>0.04);
    foreach ($result as $number){
        if($number > 0)
            $resultCompressed[key($result)] = $number;
        next($result);
    }
    $difference = array_diff($resultExpected,$resultCompressed);
    $difference2 = array_diff($resultCompressed,$resultExpected);

    var_dump($resultCompressed);
    var_dump($resultExpected);

    if(count($difference) == 0 && count($difference2)==0){
        echo "Test réussi, fonctionne comme attendu";
    }
    else{
        echo "Test échoué, ne fonctionne pas comme attendu";
    }
}
testGetTagsModel($client);
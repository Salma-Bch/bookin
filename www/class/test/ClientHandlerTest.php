<?php

use dao\DAOFactory;

$daoFactory = DAOFactory::getInstance();
$clientDao = $daoFactory->getClientDao();
$client = $clientDao->find(client que tu veut);


 function testGetLikedCategories($client){

     $clientHandler = new \controller\ClientHandler($client);
     $result = $clientHandler->getLikedBooksCategories();   //Tableau abec les categories

     $resultExcpected = array("B-E"=>2,"BD"=>6);

     $difference = array_diff($result,$resultExcpected);

     if(count($difference) == 0){
         echo "Test réussi, fonctionne comme attendu";
     }
     else{
         echo "Test échoué, ne fonctionne pas comme attendu";
     }
 }

<?php

use dao\DAOFactory;
use model\Client;

include_once('../class/dao/DAOFactory.php');
include_once('../class/dao/object/ClientDao.php');
include_once('../class/dao/object/ClientDaoImpl.php');
include_once('../class/dao/object/LikesDao.php');
include_once('../class/dao/object/LikesDaoImpl.php');
include_once('../class/model/Client.php');
include_once('../class/model/Likes.php');
include_once('../class/dao/DAOUtility.php');
include_once('../class/dao/exception/DAOException.php');
include_once('../class/utility/Format.php');
session_start();

try {

    $clientDao = DAOFactory::getInstance()->getClientDao();
    $birthDate = new DateTime($_POST['birthDay'] . "-" . $_POST['birthMonth'] . "-" .$_POST['birthYear']);
        $tags = array();
        if(isset($_POST['tags'])){
            foreach ($_POST['tags'] as $tag){
                array_push($tags, $tag);
            }
        }
    $client = new Client($_POST['client_id'], $_POST['last_name'], $_POST['first_name'], $_POST['mail'],
        $_POST['psd'], $birthDate, $_POST['profession'], $_POST['sex'], $tags);
    if (!isset($client)) {
        echo "maj:no";
        exit(-1);
    }

    else {
        $clientDao->update($client);
        $_SESSION['bookinClient'] = $client;
        echo json_encode($client->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE);
        exit(0);
    }
}
catch (Exception $e) {
    echo "maj:no";
}

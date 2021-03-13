<?php
use dao\DAOFactory;
use model\Client;

include_once('../class/dao/DAOFactory.php');
include_once('../class/dao/object/ClientDao.php');
include_once('../class/dao/object/ClientDaoImpl.php');
include_once('../class/model/Client.php');
include_once('../class/dao/DAOUtility.php');
include_once('../class/dao/exception/DAOException.php');
session_start();

if(isset($_POST['email'], $_POST['password'])){

    $daoFactory = DAOFactory::getInstance();
    $clientDao = $daoFactory->getClientDao();
    $client = $clientDao->find($_POST['email'], $_POST['password']);
    if( $client != null ) {
        $_SESSION['bookinClient'] = $client;
        echo "authentication successful";
        exit(0);
    }
}
echo "authentication failed";
exit(-1);



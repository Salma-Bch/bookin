<?php
use dao\DAOFactory;

include_once('../class/dao/DAOFactory.php');
include_once('../class/dao/object/AdministratorDao.php');
include_once('../class/dao/object/AdministratorDaoImpl.php');
include_once('../class/model/Administrator.php');
include_once('../class/dao/DAOUtility.php');
include_once('../class/dao/exception/DAOException.php');
session_start();

if(isset($_POST['email'], $_POST['password'])){
    $daoFactory = DAOFactory::getInstance();
    $administratorDao = $daoFactory->getAdministratorDao();
    $administrator = $administratorDao->find($_POST['email'], $_POST['password']);
    if( $administrator != null ) {
        $_SESSION['bookinAdministrator'] = $administrator;
        echo "authentication successful";
        exit(0);
    }
}
echo "authentication failed";
exit(-1);



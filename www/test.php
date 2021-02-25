<?php



include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/dao/object/ClientDao.php');
include_once('./class/dao/object/ClientDaoImpl.php');
include_once('./class/model/Client.php');
include_once('./class/model/Book.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');
include_once('./class/model/Purchase.php');
include_once('./class/dao/object/PurchaseDao.php');
include_once('./class/dao/object/PurchaseDaoImpl.php');


use dao\DAOFactory;
use model\Purchase;

$daoFactory = DAOFactory::getInstance();
$purchaseDao = $daoFactory->getPurchaseDao();
$purchases = $purchaseDao->getClientPurchases("00000012");
var_dump($purchases);


<?php
use dao\DAOFactory;
use model\Client;
use model\Purchase;
use utility\Format;


include_once('../class/dao/DAOFactory.php');
include_once('../class/dao/object/PurchaseDao.php');
include_once('../class/dao/object/PurchaseDaoImpl.php');
include_once('../class/model/Purchase.php');
include_once('../class/dao/object/BookDao.php');
include_once('../class/dao/object/BookDaoImpl.php');
include_once('../class/model/Book.php');
include_once('../class/model/Client.php');
include_once('../class/utility/Format.php');
include_once('../class/dao/DAOUtility.php');
include_once('../class/dao/exception/DAOException.php');
session_start();
$client = $_SESSION['bookinClient'] ;
if(isset($_POST['bookId']) && $client != null ){

    $daoFactory = DAOFactory::getInstance();
    $purchaseDao = $daoFactory->getPurchaseDao();
    $bookDao = $daoFactory->getBookDao();
    $book = $bookDao->find(Format::getFormatId(8,$_POST['bookId']));

    //Regarde si ya deja un livre acheter pour CE client
   // $purchaseDao = $daoFactory->getPurchaseDao();
    $purchase = $purchaseDao->find(Format::getFormatId(8,$client->getClientId()), Format::getFormatId(8,$_POST['bookId']));

    //Si deja acheté, incrémenté quantité et incrémenté le montant du prix du livre (update)
    if($purchase != null){
        $purchase->setQuantity($purchase->getQuantity()+1);
        $purchase->setAmount($purchase->getAmount() + $book->getPrice());
        $updated = $purchaseDao->update($purchase);
    }
    else{
        //Si jamais acheté, créée un achat avec le montant = prix du livre et quantité = 1 (CREATE)
        $purchase = new Purchase($client->getClientId(),$book->getBookId(), $book->getPrice(),1);
        $purchased = $purchaseDao->create($purchase);
    }
        echo "purchase successful";
        exit(0);
}
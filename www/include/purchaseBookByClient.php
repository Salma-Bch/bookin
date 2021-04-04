<?php
use dao\DAOFactory;
use model\Client;
use model\Purchase;
use utility\Format;


include_once('../class/dao/DAOFactory.php');
include_once('../class/dao/object/PurchaseDao.php');
include_once('../class/dao/object/PurchaseDaoImpl.php');
include_once('../class/model/Purchase.php');
include_once('../class/dao/DAOUtility.php');
include_once('../class/dao/exception/DAOException.php');
session_start();

if(isset($_POST['bookId'])){

    $daoFactory = DAOFactory::getInstance();
    $purchaseDao = $daoFactory->getPurchaseDao();
    //$purchase = $purchaseDao->find($_POST['bookId']);
    $_SESSION['bookinClient'] = $client;

    //Regarde si ya deja un livre acheter pour CE client
   // $purchaseDao = $daoFactory->getPurchaseDao();
    $purchase = $purchaseDao->find($client->getClientId(), $_POST['bookId']);

    //Si deja acheté, incrémenté quantité et incrémenté le montant du prix du livre (update)
    if($purchase != null){
        //$_SESSION['bookinClient'] = $client;

        $purchase->setQuantity($purchase->getQuantity()+1);
        $purchase->setAmount($purchase->getAmount() + $book->getPrice());
        $updated = $purchaseDao->update($purchase);
    }
    else{
        //Si jamais acheté, créée un achat avec le montant = prix du livre et quantité = 1 (CREATE)
        $purchase = new Purchase($client->getClientId(),$book->getBookId(), $book->getPrice(),1);
        $purchased = $purchaseDao->create($purchase);
    }
 //  if( $purchase != null ) {
   //   $_SESSION['bookinClient'] = $client;
        echo "purchase successful";
        exit(0);
 //  }
}
echo "purchase failed";
exit(-1);
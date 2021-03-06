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
include_once('./class/model/Evaluates.php');
include_once('./class/model/Likes.php');
include_once('./class/dao/object/PurchaseDao.php');
include_once('./class/dao/object/PurchaseDaoImpl.php');
include_once('./class/dao/object/EvaluatesDao.php');
include_once('./class/dao/object/EvaluatesDaoImpl.php');
include_once('./class/dao/object/LikesDao.php');
include_once('./class/dao/object/LikesDaoImpl.php');
include_once('./class/utility/Format.php');


use dao\DAOFactory;
use model\Book;
use model\Purchase;

$daoFactory = DAOFactory::getInstance();
$bookDao = $daoFactory->getBookDao();
$book = new Book(222, "Title", "auteur", 18, 100, 22, 25, "http://bookin.alwaysdata.net/ressources/bd/bookImages/actualite/actualite_1.png",
    array("actualite,information"), "Actualité");
$books = $bookDao->update($book);
var_dump($books);


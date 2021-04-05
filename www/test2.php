<?php



include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/dao/object/ClientDao.php');
include_once('./class/dao/object/ClientDaoImpl.php');
include_once('./class/model/Client.php');
include_once('./class/model/Tag.php');
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
include_once('./class/dao/object/TagDao.php');
include_once('./class/dao/object/TagDaoImpl.php');
include_once('./class/utility/Format.php');
include_once('./class/controller/Suggestion.php');
include_once('./class/controller/ContentModel.php');
include_once('./class/Utility/Math.php');
include_once('./class/controller/ClientHandler.php');
include_once('./class/controller/algorithm/PopularAlgorithm.php');
include_once('./class/controller/algorithm/RandomAlgorithm.php');
include_once('./class/controller/algorithm/UserAlgorithm.php');
include_once('./class/controller/algorithm/ContentAlgorithm.php');


use controller\Suggestion;
use dao\DAOFactory;

$daoFactory = DAOFactory::getInstance();
$bookDao = $daoFactory->getBookDao();
$books = $bookDao->getAll();

$clientDao = $daoFactory->getClientDao();
$client = $clientDao->find("m.lekmiti@hotmail.com", "1234");

$contentAlgorithm = new \controller\ContentAlgorithm($books, $client);
$contentModel = new \controller\ContentModel($client);
$books = $contentAlgorithm->tagBased($contentModel);

var_dump($books);

//var_dump($books);
//$suggestion = new Suggestion();
//$books = $suggestion->suggest();

/*echo '<div class="col-md-9" id="bookSearched" style="background-color: #d6d6d6">';
foreach ($books as $book) {
    echo '<div class="col-md-4 livres">' .
        '<p>Titre : '.$book->getTitle().'</p>' .
        '<img src="'.$book->getImagePath().'"  style="width: 140px;height: 190px;">' .
        '<p>'.$book->getPrice().'€</p>' .
        '</div>';
}
echo '</div>';*/



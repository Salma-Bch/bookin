<?php

use dao\DAOFactory;
use model\Book;
use model\Tag;
use utility\Format;

include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/model/Book.php');
include_once('./class/dao/object/TagDao.php');
include_once('./class/dao/object/TagDaoImpl.php');
include_once('./class/model/Tag.php');
include_once('./class/dao/object/PurchaseDao.php');
include_once('./class/dao/object/PurchaseDaoImpl.php');
include_once('./class/model/Purchase.php');
include_once('./class/dao/object/EvaluatesDao.php');
include_once('./class/dao/object/EvaluatesDaoImpl.php');
include_once('./class/model/Evaluates.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');
include_once('./class/utility/Format.php');

    $addedLine = 0;
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $tagDao = $daoFactory->getTagDao();
    $purchaseDao = $daoFactory->getPurchaseDao();
    $evaluatesDao = $daoFactory->getEvaluatesDao();

    //Pour insertion de livres
   /* $csvFile = fopen("./ressources/bd/db_book.csv","r");
    $lineCsv = fgetcsv($csvFile,1024, ";");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {

        $book = new Book($lineCsv[0], utf8_encode($lineCsv[1]), utf8_encode($lineCsv[2]),
            utf8_encode($lineCsv[3]), (int)$lineCsv[4], (float)$lineCsv[5],
            "http://bookin.alwaysdata.net/ressources/bd/bookImages/".utf8_encode($lineCsv[9])."/".utf8_encode($lineCsv[6]),
            explode(",",utf8_encode($lineCsv[7])),utf8_encode($lineCsv[8]));
        $bookDao->create($book);
        $addedLine++;
    }*/

    //Pour l'insertion des tags
    /*$csvFile = fopen("./ressources/bd/db_tag.csv","r");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $booksId = explode(",",$lineCsv[1]);
        for($i=0; $i<count($booksId);$i++){
            $booksId[$i] = \utility\Format::getFormatId(8,$booksId[$i]);
        }
        $booksId = implode(",",$booksId);
        $tag = new Tag(utf8_encode($lineCsv[0]),$booksId);
        $tagDao->create($tag);
        $addedLine++;
    }*/

    //Pour l'insertion des buys
    /*$csvFile = fopen("./ressources/bd/db_buys.csv","r");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $purchase = new \model\Purchase($lineCsv[0],$lineCsv[1], $lineCsv[2], $lineCsv[3]);
        $purchaseDao->create($purchase);
        $addedLine++;
    }*/

    //Pour l'insertion des evaluates
   /* $csvFile = fopen("./ressources/bd/db_evaluates.csv","r");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $evaluates = new \model\Evaluates(Format::getFormatId(8,$lineCsv[0]),Format::getFormatId(8,$lineCsv[1]),$lineCsv[2]);
        $evaluatesDao->create($evaluates);
        $addedLine++;
    } */

    //Pour la mise à jour des livres
    $csvFile = fopen("./ressources/bd/db_book.csv","r");
    $lineCsv = fgetcsv($csvFile,1024, ";");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {

        $book = new Book($lineCsv[0], utf8_encode($lineCsv[1]), utf8_encode($lineCsv[2]),
        utf8_encode($lineCsv[3]), (int)$lineCsv[4], (float)$lineCsv[5],
        "http://bookin.alwaysdata.net/ressources/bd/bookImages/".utf8_encode($lineCsv[9])."/".utf8_encode($lineCsv[6]),
        explode(",",utf8_encode($lineCsv[7])),utf8_encode($lineCsv[8]));
        $bookDao->update($book);
        $addedLine++;
    }

    echo $addedLine;


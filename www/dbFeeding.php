<?php

use dao\DAOFactory;
use model\Book;
use model\Tag;

include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/model/Book.php');
include_once('./class/dao/object/TagDao.php');
include_once('./class/dao/object/TagDaoImpl.php');
include_once('./class/model/Tag.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');
include_once('./class/utility/Format.php');

    $addedLine = 0;
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $tagDao = $daoFactory->getTagDao();

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
    $csvFile = fopen("./ressources/bd/db_tag.csv","r");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $booksId = explode(",",$lineCsv[1]);
        for($i=0; $i<count($booksId);$i++){
            $booksId[$i] = \utility\Format::getFormatId(8,$booksId[$i]);
        }
        $booksId = implode(",",$booksId);
        $tag = new Tag(utf8_encode($lineCsv[0]),$booksId);
        $tagDao->create($tag);
        $addedLine++;
    }

    echo $addedLine;


<?php

use dao\DAOFactory;
use model\Book;
include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/model/Book.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');

    $addedLine = 0;
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();

    $csvFile = fopen("./db_book.csv","r");
    $lineCsv = fgetcsv($csvFile,1024, ";");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $book = new Book((int)$lineCsv[0], utf8_encode($lineCsv[1]), utf8_encode($lineCsv[2]), utf8_encode($lineCsv[3]), (int)$lineCsv[4], (float)$lineCsv[5], (int)$lineCsv[6], utf8_encode($lineCsv[7]), utf8_encode($lineCsv[8]));
        $bookDao->create($book);
        $addedLine++;
        break;
    }

    echo $addedLine;


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

    $csvFile = fopen("./ressources/bd/db_book.csv","r");
    $lineCsv = fgetcsv($csvFile,1024, ";");
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $bookId = str_pad(((int)$lineCsv[0]),8,0, STR_PAD_LEFT);
        $book = new Book($lineCsv[0], utf8_encode($lineCsv[1]), utf8_encode($lineCsv[2]),
            utf8_encode($lineCsv[3]), (int)$lineCsv[4], (float)$lineCsv[5],
            (int)$lineCsv[6], "http://bookin.alwaysdata.net/ressources/bd/bookImages/".utf8_encode($lineCsv[9])."/".utf8_encode($lineCsv[7]), utf8_encode($lineCsv[8]));
        echo $book->getCategoryName();
        $bookDao->create($book);
        $addedLine++;
    }

    echo $addedLine;


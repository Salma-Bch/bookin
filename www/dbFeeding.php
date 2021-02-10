<?php

use dao\DAOFactory;
use model\Book;
include_once('./classproject/dao/DAOFactory.php');
include_once('./classproject/dao/object/BookDao.php');
include_once('./classproject/dao/object/BookDaoImpl.php');
include_once('./classproject/model/Book.php');

    $addedLine = 0;
    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();

    $csvFile = fopen("./db_book.csv","r");

    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        try {
            $image = new Imagick("./bookImages/" . $lineCsv[7]);
        } catch (ImagickException $e) {
            echo "probleme lecture image";
        }
        $book = new Book($lineCsv[0], $lineCsv[1], $lineCsv[2], $lineCsv[3], $lineCsv[4], $lineCsv[5], $lineCsv[6], $image, $lineCsv[8]);
        $bookDao->create($book);
        $addedLine++;
    }

    echo $addedLine;


<?php

use model\Book;

    $addedLine = 0;
    $daoFactory = \dao\DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();

    $csvFile = fopen("./db_book.csv","r");

    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $image = new Imagick("./bookImages/".$lineCsv[7]);
        $book = new Book($lineCsv[0], $lineCsv[1], $lineCsv[2], $lineCsv[3], $lineCsv[4], $lineCsv[5], $lineCsv[6], $image->getImageBlob(), $lineCsv[8]);
        $bookDao->create($book);
        $addedLine++;
    }

    echo $addedLine;


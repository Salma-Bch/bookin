<?php

namespace dao\object;

use model\Book;

interface BookDao
{
    function create(Book $book): bool;
    function find(String $bookId): ?Book;
    function update(Book $book): bool;
}
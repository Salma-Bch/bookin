<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Book;

class BookDaoImpl implements BookDao
{
    private const SQL_SELECT_BY_BOOK_ID = "SELECT book_id, title, author, age_range, number_pages, price, quantity, book_image, category_name FROM book WHERE book_id = ?";
    private const SQL_INSERT = "INSERT INTO book (book_id, title, author, age_range, number_pages, price, quantity, book_image, category_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    private const SQL_UPDATE = "UPDATE book SET title=?, author=?, age_range=?, number_pages=?, price=?, quantity=?, book_image=?, category_name=? WHERE book_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->$daoFactory = $daoFactory; }

    public function find(String $bookId): Book
    {
        $book = null;
        $parameters = array($bookId);
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_BY_BOOK_ID);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $bookReturned = $preparedStatement->fetchObject();
                $book = $this->map($bookReturned);
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $book;
    }

    function create(Book $book): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute((array)$book);
            if ($status == 0)
                throw new DAOException("Book creation failed, no line added");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    function update(Book $book): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute((array)$book);
            if ($status == 0)
                throw new DAOException("Book update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($br): Book{
        return new Book($br->book_id,$br->title,$br->author,$br->age_range,$br->number_pages,$br->price,$br->quantity,$br->book_image, $br->category_name); // Changer br->book_image,
        // creer l'image puis l'inseret
    }

}
<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use dao\object\BookDao;
use model\Book;

class BookDaoImpl implements BookDao
{
    private const SQL_SELECT_BY_BOOK_ID = "SELECT book_id, title, author, age_range, number_pages, price, image_path, tags, category_name FROM book WHERE book_id = ?";
    private const SQL_SELECT_ALL_BOOKS = "SELECT book_id, title, author, age_range, number_pages, price, image_path, tags, category_name FROM book";
    private const SQL_SELECT_MAX_PRICE = "SELECT price FROM book ORDER BY price DESC LIMIT 1";
    private const SQL_SELECT_ALL_BOOKS_BY_FILTERS = "SELECT book_id, title, author, age_range, number_pages, price, image_path, tags, category_name FROM book WHERE";
    private const SQL_INSERT = "INSERT INTO book (book_id, title, author, age_range, number_pages, price, image_path, tags, category_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    private const SQL_UPDATE = "UPDATE book SET title=?, author=?, age_range=?, number_pages=?, price=?, image_path=?, tags=?, category_name=? WHERE book_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->daoFactory = $daoFactory; }

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

    public function getMaxPrice(){
        $price = null;
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_MAX_PRICE);
            $status = $preparedStatement->execute();
            if($status){
                $priceReturned = $preparedStatement->fetchObject();
                $price = $priceReturned->price;
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $price;
    }
    public function getAll(array $filters=null): array
    {
        $books = array();
        $request = self::SQL_SELECT_ALL_BOOKS;
        if($filters != null && count($filters) != 0){
            $request = self::SQL_SELECT_ALL_BOOKS_BY_FILTERS;
            if( isset($filters['categories']) && $filters['categories'] != "" ){
                $categories = $filters['categories'];
                $request .= " category_name IN (";
                foreach ($categories as $category){
                    $request .= "'".$category."', ";
                }
                $request = substr($request, 0, -2);
                $request .= ")";
            }
            else
                $request .= " 1=1";

            $request .=" AND";

            if( isset($filters['agesRange']) && $filters['agesRange'] != "" ) {
                $agesRange = $filters['agesRange'];
                $request .= " age_range IN (";
                foreach ($agesRange as $ageRange){
                    $request .= "'".$ageRange."', ";
                }
                $request = substr($request, 0, -2);
                $request .= ")";
            }
            else
                $request .= " 1=1";

            $request .=" AND";

            if( isset($filters['prices']) && $filters['prices'] != "" ) {
                $prices = $filters['prices'];
                $request .= " price BETWEEN ";
                $request .= $prices[0]." AND ";
                $request .= $prices[1];
            }
            else
                $request .= " 1=1";

        }
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute();
            if($status) {
                $dbBooks = $preparedStatement->fetchAll();
                foreach ($dbBooks as $book) {
                    array_push($books, $this->map($book,true));
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $books;
    }

    function create(Book $book): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($book->toArray());
            if ($status == 0)
                throw new DAOException("Book creation failed, no line added; ");
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
            $status = $preparedStatement->execute($book->toArray(true));
            var_dump($preparedStatement->errorInfo());
            if ($status == 0)
                throw new DAOException("Book update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($br,$array=false): Book{
        if($array)
            return new Book($br['book_id'],$br['title'],$br['author'],$br['age_range'],$br['number_pages'],$br['price'],
                $br['image_path'], explode(",",$br['tags']), $br['category_name']);
        else
            return new Book($br->book_id,$br->title,$br->author,$br->age_range,$br->number_pages,$br->price,
                $br->image_path, explode(",",$br->tags), $br->category_name);
    }

}
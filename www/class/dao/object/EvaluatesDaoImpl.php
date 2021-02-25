<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use dao\object\EvaluatesDao;
use model\Evaluates;

class EvaluatesDaoImpl implements EvaluatesDao
{
    private const SQL_SELECT_BY_CLIENT_ID = "SELECT client_id, book_id, satisfied FROM evaluates WHERE client_id = ?";
    private const SQL_SELECT_BY_BOOK_ID = "SELECT client_id, book_id, satisfied FROM evaluates WHERE book_id = ?";
    private const SQL_SELECT_ALL_EVALUATES = "SELECT client_id, book_id, satisfied FROM evaluates";
    private const SQL_INSERT = "INSERT INTO evaluates (client_id, book_id, satisfied) VALUES (?, ?, ?)";
    private const SQL_UPDATE = "UPDATE evaluates SET client_id=?, book_id=?, satisfied=? WHERE client_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->daoFactory = $daoFactory; }

    public function find(String $bookId): Evaluates
    {
        $evaluates = null;
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
        return $evaluates;
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

    function create(Evaluates $evaluates): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($evaluates->toArray());
            if ($status == 0)
                throw new DAOException("Evaluates creation failed, no line added; ");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    function update(Evaluates $evaluates): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute($evaluates->toArray());
            if ($status == 0)
                throw new DAOException("Evaluates update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($br,$array=false): Evaluates{
        if($array)
            return new Evaluates($br['client_id'],$br['book_id'],$br['satisfied']);
        else
            return new Evaluates($br->client_id,$br->book_id,$br->satisfied);
    }

}
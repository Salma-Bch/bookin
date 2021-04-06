<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use dao\object\EvaluatesDao;
use model\Evaluates;

class EvaluatesDaoImpl implements EvaluatesDao
{
    private const SQL_SELECT_BY_BOOK_ID = "SELECT client_id, book_id, satisfied FROM evaluates WHERE book_id = ?";
    private const SQL_SELECT_BY_CLIENT_ID = "SELECT client_id, book_id, satisfied FROM evaluates WHERE client_id = ?";
    private const SQL_SELECT_BY_BOOK_ID_AND_CLIENT_ID = "SELECT client_id, book_id, satisfied FROM evaluates WHERE book_id = ? AND client_id=?";
    private const SQL_SELECT_ALL = "SELECT client_id, book_id, satisfied FROM evaluates";
    private const SQL_SELECT_ALL_LIMIT = "SELECT book_id, COUNT(book_id) as count FROM evaluates WHERE satisfied=1 GROUP BY book_id ORDER BY count DESC";
    private const SQL_SELECT_EXCEPT_LIMIT = "SELECT book_id, satisfied, COUNT(*) FROM evaluates WHERE satisfied=1 AND book_id NOT IN (arrayIn) GROUP BY book_id, satisfied ORDER BY COUNT(*) DESC";
    private const SQL_INSERT = "INSERT INTO evaluates (client_id, book_id, satisfied) VALUES (?, ?, ?)";
    private const SQL_UPDATE = "UPDATE evaluates SET client_id=?, book_id=?, satisfied=? WHERE client_id=?";


    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->daoFactory = $daoFactory; }

    public function getBestRated(int $nbrOfBooks, array $except=null){
        $parameters = $except;
        $request = self::SQL_SELECT_ALL_LIMIT;
        if(isset($except)){
            $request = self::SQL_SELECT_EXCEPT_LIMIT;
            $in = str_repeat("?,",count($except)-1)."?";
            $request = str_replace("arrayIn",$in,$request);
        }
        $request .=" LIMIT ".$nbrOfBooks;

        $booksId = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute($parameters);
            if($status){
                $evaluatesReturned = $preparedStatement->fetchAll();
                foreach ($evaluatesReturned as $evaluates) {
                    array_push($booksId, $evaluates['book_id']);
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $booksId;
    }

    public function getBestRatedCount(int $nbrOfBooks){
        $request = self::SQL_SELECT_ALL_LIMIT;
        $request .=" LIMIT ".$nbrOfBooks;

        $books = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute();
            if($status){
                $evaluatesReturned = $preparedStatement->fetchAll();
                //var_dump($evaluatesReturned);
                foreach ($evaluatesReturned as $evaluates) {
                    $books[$evaluates['book_id']] = $evaluates['count'];
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $books;
    }

    public function find(String $bookId=null, String $clientId=null): array {
        $parameters = array();
        if($bookId != null && $clientId != null){
            $request = self::SQL_SELECT_BY_BOOK_ID_AND_CLIENT_ID;
            array_push($parameters, $bookId);
            array_push($parameters, $clientId);
        }
        else{
            if($bookId != null){
                $request = self::SQL_SELECT_BY_BOOK_ID;
                array_push($parameters, $bookId);
            }
            else if($clientId != null){
                $request = self::SQL_SELECT_BY_CLIENT_ID;
                array_push($parameters, $clientId);
            }
            else{
                $request = self::SQL_SELECT_ALL;
            }
        }

        $evaluatesArray = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $evaluatesReturned = $preparedStatement->fetchAll();
                foreach ($evaluatesReturned as $evaluates) {
                    array_push($evaluatesArray, $this->map($evaluates,true));
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $evaluatesArray;
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
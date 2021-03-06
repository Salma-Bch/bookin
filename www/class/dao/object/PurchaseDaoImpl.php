<?php


namespace dao\object;


use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Purchase;
use utility\Format;

class PurchaseDaoImpl implements PurchaseDao {
    private const SQL_SELECT_PURCHASES_BY_CLIENT_ID = "SELECT client_id, book_id, amount, quantity FROM buys WHERE client_id=?";
    private const SQL_SELECT_PURCHASES_BY_CLIENT_ID_AND_BOOK_ID = "SELECT client_id, book_id, amount, quantity FROM buys WHERE client_id=? AND book_id=?";
    private const SQL_SELECT_MOST_PURCHASED_BOOK = "SELECT book_id,COUNT(*) FROM buys GROUP BY book_id ORDER BY COUNT(*) DESC";
    private const SQL_INSERT = "INSERT INTO buys (client_id, book_id, amount, quantity) VALUES (?, ?, ?,?)";
    private const SQL_UPDATE ="UPDATE buys SET amount=?, quantity=? WHERE client_id=? AND book_id=?";
    private DAOFactory $daoFactory;

    /**
     * PurchaseDaoImpl constructor.
     * @param DAOFactory $daoFactory
     */
    public function __construct(DAOFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
    }

    function create(Purchase $purchase): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($purchase->toArray(true));
            if ($status == 0)
                throw new DAOException("Purchase creation failed, no line added; ");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    public function getClientPurchases(int $clientId): array
    {
        $purchases = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_PURCHASES_BY_CLIENT_ID);
            $status = $preparedStatement->execute( array(Format::getFormatId(8,$clientId)) );
            if($status) {
                $dbPurchases = $preparedStatement->fetchAll();
                foreach ($dbPurchases as $purchase) {
                    array_push($purchases, $this->map($purchase,true));
                }
            }
        } catch (\Exception $e){
            echo $e;
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $purchases;
    }

    public function getMostPurchasedBooks(int $nbrOfBooks=null): array{
        $request = self::SQL_SELECT_MOST_PURCHASED_BOOK;
        if(isset($nbrOfBooks))
            $request .= " LIMIT ".$nbrOfBooks;

        $booksId = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute();
            if($status) {
                $dbPurchases = $preparedStatement->fetchAll();
                foreach ($dbPurchases as $purchase) {
                    array_push($booksId, $purchase['book_id']);
                }
            }
        } catch (\Exception $e){
            echo $e;
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $booksId;
    }

    public function find(int $clientId, int $bookId): ?Purchase
    {
        $purchase = null;
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_PURCHASES_BY_CLIENT_ID_AND_BOOK_ID);
            $status = $preparedStatement->execute( array(Format::getFormatId(8,$clientId), Format::getFormatId(8,$bookId)) );
            $dbPurchase = $preparedStatement->fetchObject();
            if($status && $dbPurchase) {
                $purchase =  $this->map($dbPurchase,false);
            }
        } catch (\Exception $e){
            echo $e;
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $purchase;
    }

    function update(Purchase $purchase): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute($purchase->toArray(false));
            if ($status == 0)
                throw new DAOException("Purchase update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($pr,$array=false): Purchase{
        if($array)
            return new Purchase($pr['client_id'],$pr['book_id'],$pr['amount'],$pr['quantity']);
        else
            return new Purchase($pr->client_id,$pr->book_id,$pr->amount,$pr->quantity);
    }
}
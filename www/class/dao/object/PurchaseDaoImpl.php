<?php


namespace dao\object;


use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Purchase;
use utility\Format;

class PurchaseDaoImpl implements PurchaseDao {
    private const SQL_SELECT_PURCHASES_BY_CLIENT_ID = "SELECT client_id, book_id, amount FROM buys WHERE client_id=?";
    private const SQL_INSERT = "INSERT INTO buys (client_id, book_id, amount) VALUES (?, ?, ?)";
    private const SQL_UPDATE ="UPDATE buys SET client_id=?, book_id=?, amount=? WHERE client_id=?";

    private DAOFactory $daoFactory;

    /**
     * PurchaseDaoImpl constructor.
     * @param DAOFactory $daoFactory
     */
    public function __construct(DAOFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
    }

    /*public function find(int $clientId, int $bookId): Purchase
    {
        $purchase = null;
        $parameters = array($clientId);
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_BY_CLIENT_ID);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $purchaseReturned = $preparedStatement->fetchObject();
                $purchase = $this->map($purchaseReturned);
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $purchase;
    }*/

    function create(Purchase $purchase): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($purchase->toArray());
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
                    echo"Rentrer";
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

    function update(Purchase $purchase): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute($purchase->toArray());
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
            return new Purchase($pr['client_id'],$pr['book_id'],$pr['amount']);
        else
            return new Purchase($pr->client_id,$pr->book_id,$pr->amount);
    }
}
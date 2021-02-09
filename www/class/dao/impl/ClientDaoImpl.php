<?php

namespace dao\impl;

use dao\ClientDao;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Client;

class ClientDaoImpl implements ClientDao {
    private const SQL_SELECT_BY_CLIENT_ID = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money FROM client WHERE client_id = ?";
    private const SQL_SELECT_BY_MAIL = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money FROM client WHERE mail = ?";
    private const SQL_INSERT = "INSERT INTO client (client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money) VALUES (?, ? ,? ,? ,? ,? ,?, ?, ?)";
    private const SQL_UPDATE = "UPDATE clients SET last_name=?, first_name=?, mail=?, psd=?, birth_date=?, profession=?, sex=?, client_money=? WHERE client_id=?";

    private \DAOFactory $daoFactory;

    public function __construct(\DAOFactory $daoFactory) { $this->$daoFactory = $daoFactory; }

    public function find(String $mail): Client
    {
        $client = null;
        $parameters = array($mail);
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_BY_MAIL);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $clientReturned = $preparedStatement->fetchObject();
                $client = $this->map($clientReturned);
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $client;
    }

    function create(Client $client): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute((array)$client);
            if ($status == 0)
                throw new DAOException("Client creation failed, no line added");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    function update(Client $client): bool
    {
        // TODO: Implement update() method.
    }

    private function map($cr): Client{
        return new Client($cr->client_id,$cr->last_name,$cr->first_name,$cr->mail,$cr->psd,$cr->birth_date,$cr->profession,$cr->sex,$cr->client_money);
    }
}
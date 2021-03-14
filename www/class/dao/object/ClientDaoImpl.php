<?php

namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Client;

class ClientDaoImpl implements ClientDao {
    private const SQL_SELECT_BY_CLIENT_ID = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, tags FROM client WHERE client_id = ?";
    private const SQL_SELECT_MAX_ID = "SELECT MAX(client_id) as max_id FROM client";
    private const SQL_SELECT_BY_MAIL = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, tags FROM client WHERE mail = ?";
    private const SQL_SELECT_BY_MAIL_AND_PASSWORD = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, tags FROM client WHERE mail = ? AND psd=?";
    private const SQL_INSERT = "INSERT INTO client (client_id, last_name, first_name, mail, psd, birth_date, profession, sex, tags) VALUES (?, ? ,? ,? ,? ,? ,?, ?, ?, ?)";
    private const SQL_UPDATE = "UPDATE client SET last_name=?, first_name=?, mail=?, psd=?, birth_date=?, profession=?, sex=?, tags=? WHERE client_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->daoFactory = $daoFactory; }

    public function find(String $mail, String $password=null): Client
    {
        $client = null;
        $request = self::SQL_SELECT_BY_MAIL;
        $parameters = array($mail);
        if($password != null) {
            array_push($parameters, $password);
            $request = self::SQL_SELECT_BY_MAIL_AND_PASSWORD;
        }
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
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

    public function getMaxId(): int
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_MAX_ID);
            $status = $preparedStatement->execute();

            if($status)
                $maxId = (int)$preparedStatement->fetchObject()->max_id;
            else
                throw new DAOException("getting maximum id failed ");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $maxId;
    }

    function create(Client $client): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($client->toArray());
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
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute((array)$client);
            if ($status == 0)
                throw new DAOException("Client update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($cr): Client{
        try {
            $birthDate = new \DateTime($cr->birth_date);
        } catch (\Exception $e) {
            echo($e);
        }
        return new Client($cr->client_id,$cr->last_name,$cr->first_name,$cr->mail,$cr->psd,$birthDate,$cr->profession,$cr->sex,explode(",", $cr->tags));
    }
}
<?php

namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Administrator;

class AdministratorDaoImpl implements AdministratorDao {
    private const SQL_SELECT_BY_ADMIN_ID = "SELECT admin_id, last_name, first_name, mail, psd FROM administrator WHERE admin_id = ?";
    private const SQL_SELECT_MAX_ID = "SELECT MAX(admin_id) as max_id FROM administrator";
    private const SQL_SELECT_BY_MAIL = "SELECT admin_id, last_name, first_name, mail, psd FROM administrator WHERE mail = ?";
    private const SQL_SELECT_BY_MAIL_AND_PASSWORD = "SELECT admin_id, last_name, first_name, mail, psd FROM administrator WHERE mail = ? AND psd=?";
    private const SQL_INSERT = "INSERT INTO administrator (admin_id, last_name, first_name, mail, psd) VALUES (?, ? ,? ,? ,?)";
    private const SQL_UPDATE = "UPDATE administrator SET last_name=?, first_name=?, mail=?, psd=? WHERE admin_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->daoFactory = $daoFactory; }

    public function find(String $mail, String $password=null): ?Administrator
    {
        $administrator = null;
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
            $administratorReturned = $preparedStatement->fetchObject();
            if($status && $administratorReturned){
                $administrator = $this->map($administratorReturned);
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $administrator;
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

    function create(Administrator $administrator): bool
    {
        $success = true;
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($administrator->toArray());
            if ($status == 0) {
                $success = false;
                throw new DAOException("Administrator creation failed, no line added");
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $success;
    }

    function update(Administrator $administrator): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute((array)$administrator);
            if ($status == 0)
                throw new DAOException("Administrator update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($cr): Administrator{
        return new Administrator($cr->admin_id,$cr->last_name,$cr->first_name,$cr->mail,$cr->psd);
    }
}
<?php

namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Administrator;

class AdministratorDaoImpl implements AdministratorDao
{
    private const SQL_SELECT_BY_ADMIN_ID = "SELECT book_id, title, author, age_range, number_pages, price, quantity, book_image, category_name FROM book WHERE book_id = ?";
    private const SQL_INSERT = "INSERT INTO book (book_id, title, author, age_range, number_pages, price, quantity, book_image, category_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    private const SQL_UPDATE = "UPDATE book SET title=?, author=?, age_range=?, number_pages=?, price=?, quantity=?, book_image=?, category_name=? WHERE book_id=?";

    private DAOFactory $daoFactory;

    public function __construct(DAOFactory $daoFactory) { $this->$daoFactory = $daoFactory; }

    function create(Administrator $administrator): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute((array)$administrator);
            if ($status == 0)
                throw new DAOException("Administrator creation failed, no line added");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    function find(string $adminId): Administrator
    {
        $admin = null;
        $parameters = array($adminId);
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_BY_ADMIN_ID);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $adminReturned = $preparedStatement->fetchObject();
                $admin = $this->map($adminReturned);
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $admin;
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

    private function map($br): Administrator{
        return new Administrator($br->admin_id,$br->last_name,$br->first_name,$br->mail,$br->psd);
    }
}
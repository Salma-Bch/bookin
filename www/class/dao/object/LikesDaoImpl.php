<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Likes;
use utility\Format;


class LikesDaoImpl implements LikesDao {
    private const SQL_SELECT_LIKES_BY_CLIENT_ID = "SELECT client_id, category_name FROM likes WHERE client_id=?";
    private const SQL_INSERT = "INSERT INTO likes (client_id, category_name) VALUES (?, ?)";
    private const SQL_UPDATE ="UPDATE likes SET client_id=?, category_name=? WHERE client_id=?";

    private DAOFactory $daoFactory;

    /**
     * LikesDaoImpl constructor.
     * @param DAOFactory $daoFactory
     */
    public function __construct(DAOFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
    }

    function create(Likes $likes): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($likes->toArray());
            if ($status == 0)
                throw new DAOException("Likes creation failed, no line added; ");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    public function getClientLikes(int $clientId): array
    {
        $likes = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_LIKES_BY_CLIENT_ID);
            $status = $preparedStatement->execute( array(Format::getFormatId(8,$clientId)) );
            if($status) {
                $dbLikes = $preparedStatement->fetchAll();
                foreach ($dbLikes as $like) {
                    array_push($likes, $this->map($like,true));
                }
            }
        } catch (\Exception $e){
            echo $e;
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $likes;
    }

    function update(Likes $like): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute($like->toArray());
            if ($status == 0)
                throw new DAOException("Likes update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($br,$array=false): Likes{
        if($array)
            return new Likes($br['client_id'], $br['category_name']);
        else
            return new Likes($br->client_id, $br->category_name);
    }


}
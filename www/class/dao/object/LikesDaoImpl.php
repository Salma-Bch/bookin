<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Likes;
use utility\Format;


class LikesDaoImpl implements LikesDao {
    private const SQL_SELECT_LIKES_BY_CLIENT_ID = "SELECT client_id, category_name FROM likes WHERE client_id=?";
    private const SQL_SELECT_LIKES_BY_CATEGORY_NAME = "SELECT client_id, category_name FROM likes WHERE category_name=?";
    private const SQL_SELECT_MOST_CATEGORY_LIKED = "SELECT category_name, COUNT(*) as count FROM likes GROUP BY category_name ORDER BY COUNT(*) DESC";
    private const SQL_SELECT_ALL = "SELECT client_id, category_name FROM likes";
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

    public function find(String $clientId=null, String $category_name=null): array {
        $parameters = array();
        if($clientId != null && $category_name != null){
            $request = self::SQL_SELECT_ALL;
            array_push($parameters, $clientId);
            array_push($parameters, $category_name);
        }
        else{
            if($clientId != null){
                $request = self::SQL_SELECT_LIKES_BY_CLIENT_ID;
                array_push($parameters, $clientId);
            }
            else if($category_name != null){
                $request = self::SQL_SELECT_LIKES_BY_CATEGORY_NAME;
                array_push($parameters, $category_name);
            }
        }

        $likesArray = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $likesReturned = $preparedStatement->fetchAll();
                foreach ($likesReturned as $likes) {
                    array_push($likesArray, $this->map($likes,true));
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $likesArray;
    }

    function getMostLikedCategory(int $number):array{
        $likesArray = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_SELECT_MOST_CATEGORY_LIKED." LIMIT ".$number);
            $status = $preparedStatement->execute(array($number));
            $likesReturned = $preparedStatement->fetchAll();
            if($status && $likesReturned){
                foreach ($likesReturned as $likes) {
                    $likesArray[$likes["category_name"]] = $likes["count"];
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $likesArray;
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
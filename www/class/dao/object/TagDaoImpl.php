<?php


namespace dao\object;

use dao\DAOFactory;
use dao\DAOUtility;
use dao\exception\DAOException;
use model\Likes;
use model\Tag;
use utility\Format;


class TagDaoImpl implements TagDao {
    private const SQL_SELECT_BY_TAG_NAME = "SELECT tag_name, books_id FROM tag WHERE tag_name=?";
    private const SQL_SELECT_ALL = "SELECT tag_name, books_id FROM tag";
    private const SQL_INSERT = "INSERT INTO tag (tag_name, books_id) VALUES (?, ?)";
    private const SQL_UPDATE ="UPDATE tag SET tag_name=?, books_id=? WHERE tag_name=?";

    private DAOFactory $daoFactory;

    /**
     * LikesDaoImpl constructor.
     * @param DAOFactory $daoFactory
     */
    public function __construct(DAOFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
    }

    function create(Tag $tag): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_INSERT);
            $status = $preparedStatement->execute($tag->toArray());
            if ($status == 0)
                throw new DAOException("Likes creation failed, no line added; ");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    public function find(String $tagName=null, String $bookId=null): array {
        $parameters = array();
        $request = self::SQL_SELECT_ALL;

        if($tagName != null){
            $request = self::SQL_SELECT_BY_TAG_NAME;
            array_push($parameters, $tagName);
        }

        $tagsArray = array();
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, $request);
            $status = $preparedStatement->execute($parameters);

            if($status){
                $tagsReturned = $preparedStatement->fetchAll();
                foreach ($tagsReturned as $tag) {
                    array_push($tagsArray, $this->map($tag,true));
                }
            }
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return $tagsArray;
    }

    function update(Tag $tag): bool
    {
        try{
            $connection = $this->daoFactory->getConnection();
            $preparedStatement = DAOUtility::initPreparedStatement($connection, self::SQL_UPDATE);
            $status = $preparedStatement->execute($tag->toArray());
            if ($status == 0)
                throw new DAOException("Likes update failed, no line changed");
        } catch (\Exception $e){
            throw new DAOException($e);
        } finally {
            DAOUtility::close($preparedStatement, $connection);
        }
        return true;
    }

    private function map($br,$array=false): Tag{
        if($array)
            return new Tag($br['tag_name'], $br['books_id']);
        else
            return new Tag($br->tag_name, $br->books_id);
    }


}
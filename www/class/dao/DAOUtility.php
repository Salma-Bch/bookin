<?php


namespace dao;


use Cassandra\PreparedStatement;

class DAOUtility
{
    public static function initPreparedStatement(\PDO $connection, String $sql): \PDOStatement{
        return $connection->prepare($sql);
    }

    public static function close(\PDOStatement $statement = null, \PDO $connection = null): void{
        $statement = null;
        $connection = null;
    }
}
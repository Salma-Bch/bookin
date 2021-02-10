<?php


namespace dao;

use PDO;
use PDOStatement;

class DAOUtility
{
    public static function initPreparedStatement(PDO $connection, String $sql): PDOStatement{
        return $connection->prepare($sql);
    }

    public static function close(PDOStatement $statement = null, PDO $connection = null): void{
        $statement = null;
        $connection = null;
    }
}
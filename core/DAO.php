<?php


namespace App\core;
use PDO;
use Exception;

abstract class DAO
{
    private ?PDO $connection = null;

   private const DSN = 'mysql:dbname=musique; host=import:3306;charset=utf8';
    private const DBUSER = 'root';
    private const PASSWORD = '';


    private function getConnection()
    {
        try {
            $this->connection = new PDO(self::DSN, self::DBUSER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;

        } catch (Exception $errorConnection) {
            die('Erreur lors de la connection:' . $errorConnection->getMessage());
        }
    }

    private function checkConnection()
    {
        if ($this->connection === null) {
            return $this->getConnection();
        }
        return $this->connection;
    }

    protected function creatQuery($sql, $data = null)
    {
        if ($data) {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($data);
            return $result;
        }
        return $this->checkConnection()->query($sql);
    }
}
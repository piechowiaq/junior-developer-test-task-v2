<?php

namespace app\core;

use app\models\Product;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getAll($sql)
    {
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }


}
<?php

namespace Wrsg\App\repository;

use PDO;
use PDOStatement;

class DB
{
    private PDO $conn;

    public function __construct(dbMysql $databaseConnection)
    {
        $this->conn = $databaseConnection->getConnection();
    }

    private function setParams(PDOStatement $statement, array $parameters): void
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam(PDOStatement $statement, string $key, $value): void
    {
        $statement->bindValue($key, $value);
    }

    public function executeQuery(string $rawQuery, array $params = []): PDOStatement
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select(string $rawQuery, array $params = []): array
    {
        $stmt = $this->executeQuery($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

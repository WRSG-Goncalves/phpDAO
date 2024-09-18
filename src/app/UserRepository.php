<?php

namespace Wrsg\App;

use PDO;

class UserRepository
{
    private PDO $connection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    private function setParams($statement, $parameters = []): void
    {
        // Verifica se o array $parameters não está vazio antes de vincular os parâmetros
        if (!empty($parameters)) {
            foreach ($parameters as $key => $value) {
                $statement->bindParam($key, $value);
            }
        }
    }

    public function query(string $query, array $params = []): bool
    {
        $stmt = $this->connection->prepare($query);
        $this->setParams($stmt, $params);
        return $stmt->execute();
    }

    // Função select com parâmetros
    public function select(string $query, array $params = []): array
    {
        $stmt = $this->connection->prepare($query);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função select sem parâmetros
    public function selectWithoutParams(string $query): array
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

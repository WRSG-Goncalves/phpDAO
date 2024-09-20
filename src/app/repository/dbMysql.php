<?php

namespace Wrsg\App\repository;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class dbMysql
{
    private $connection;

    public function __construct()
    {
        $this->connection = $this->makeConnection();
    }

    private function makeConnection(): PDO
    {
        $this->loadEnvironmentVariables();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new \Exception('Connection failed: ' . $e->getMessage());
        }
    }

    private function loadEnvironmentVariables(): void
    {

        static $isLoaded = false;

        if (!$isLoaded) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));

            $dotenv->load();
            $isLoaded = true;
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

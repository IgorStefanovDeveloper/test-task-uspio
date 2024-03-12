<?php

namespace App\Helpers\DataProvider;

use PDO;
class MySQLDataProvider implements DataProviderInterface
{
    private PDO $conn;

    private static DataProviderInterface $instance;

    private function __construct($host, $db_name, $username, $password)
    {
        try {
            $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }

    public static function getInstance(string $host, string $db_name, string $username, string $password): DataProviderInterface
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($host, $db_name, $username, $password);
        }

        return self::$instance;
    }

    public function executeSql(string $sql): bool|array
    {
        $query = $sql;
        $statement = $this->conn->prepare($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);;
        }

        return false;
    }
}

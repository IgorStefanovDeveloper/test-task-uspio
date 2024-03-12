<?php

namespace App\Helpers\DataProvider;

interface DataProviderInterface
{
    public static function getInstance(string $host, string $db_name, string $username, string $password): DataProviderInterface;

    public function executeSql(string $sql): bool|array;
}

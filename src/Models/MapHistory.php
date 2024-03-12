<?php

namespace App\Models;

use App\Helpers\DataProvider\DataProviderInterface;

class MapHistory
{

    private string $tableName = 'map_history';

    private DataProviderInterface $dataProvider;

    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function create(string $address): bool
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (address) VALUES (' . $address . ')';

        if ($this->dataProvider->executeSql($query)) {
            return true;
        }

        return false;
    }

    public function getMapHistory(int $page = 1, int $perPage = 10): bool|array
    {
        $offset = ($page - 1) * $perPage;

        $query = 'SELECT * FROM map_history ORDER BY request_time DESC LIMIT ' . $offset . ',' . $perPage;

        return $this->dataProvider->executeSql($query);
    }
}

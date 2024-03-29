<?php

namespace App\Controllers\MapHistory;

use App\Controllers\Controller;
use App\Models\MapHistory;
use App\Helpers\DataProvider\DataProviderInterface;

class  SaveController extends Controller
{
    public function __invoke(DataProviderInterface $dataProvider, array $params)
    {
        $mapHistory = new MapHistory($dataProvider);

        $mapHistory->create($params['address']);
    }
}

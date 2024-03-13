<?php

namespace App\Controllers\MapHistory;

use App\Controllers\Controller;
use App\Models\MapHistory;
use App\Helpers\DataProvider\DataProviderInterface;

class  UpdatelistController extends Controller
{
    public function __invoke(DataProviderInterface $dataProvider, array $params)
    {
        $mapHistory = new MapHistory($dataProvider);

        echo json_encode($mapHistory->getMapHistory());
    }

}

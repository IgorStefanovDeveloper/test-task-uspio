<?php

namespace App\Controllers\GoogleMap;

use App\Controllers\Controller;
use App\Helpers\DataProvider\DataProviderInterface;
use App\Helpers\GoogleMap;


class HelpController extends Controller
{
    public function __invoke(DataProviderInterface $dataProvider, array $params)
    {

        $googleMap = new GoogleMap(getenv('GOOGLE_KEY'));

        echo json_encode($googleMap->getAddressSuggestions($params['query']));
    }
}

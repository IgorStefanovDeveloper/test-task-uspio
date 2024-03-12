<?php

namespace App\Controllers;

use App\Helpers\DataProvider\DataProviderInterface;
use App\Helpers\GoogleMap;
use App\Models\MapHistory;


class IndexController extends Controller
{

    const PAGE = 'index';

    public function __invoke(DataProviderInterface $dataProvider)
    {
        $title = 'mainpage';
        $description = 'mainpage';
        $h1 = 'mainpage h1';

        $googleMap = new GoogleMap(getenv('GOOGLE_KEY'));
        $staticMapUrl = $googleMap->getStaticMap('Москва', 500, 500);

        $mapHistory = new MapHistory($dataProvider);
        $mapHistoryList = $mapHistory->getMapHistory($_GET['page']?? 1, 10);


        include_once($_SERVER['DOCUMENT_ROOT'] . getenv('THEME') . 'pages/' . self::PAGE . '.php');
    }
}

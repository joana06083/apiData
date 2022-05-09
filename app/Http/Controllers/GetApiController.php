<?php

namespace App\Http\Controllers;

use App\Models\openData;
use Illuminate\Support\Facades\Http;

class GetApiController extends Controller
{
    public function index()
    {
        $ActivityInfo = openData::paginate(10);
        $data = [
            'ActivityInfo' => $ActivityInfo,
        ];

        return view('index', $data);
    }
    public function saveApiData()
    {
        $response = Http::get(
            'https://datacenter.taichung.gov.tw/swagger/OpenData/c6abbb99-b617-4379-8562-4ab115e91ead',
            [
                'operationId' => 'c6abbb99-b617-4379-8562-4ab115e91ead',
                // 'limit' => 5, //抓取幾筆
            ]);

        $Activity = json_decode($response->body());
        $ActivityTime = '活動展演(起訖)';
        $arrData = [];

        foreach ($Activity as $act) {
            $data = [
                'ActivityName' => $act->活動名稱,
                'ActivityTime' => $act->$ActivityTime,
                'ActivityTicket' => $act->活動售票與否,
                'ActivityPlace' => $act->地點,
                'ActivityTicketPrice' => $act->票價,
                'ActivityImage' => $act->相關圖片,
                'ActivityUrl' => $act->活動網址,
                'ActivityEnter' => $act->入場方式,
            ];
            array_push($arrData, $data);
        }

        $ActCheck = openData::whereIn('ActivityName', array_column($arrData, 'ActivityName'))
            ->whereIn('ActivityTime', array_column($arrData, 'ActivityTime'))
            ->whereIn('ActivityTicket', array_column($arrData, 'ActivityTicket'))
            ->whereIn('ActivityPlace', array_column($arrData, 'ActivityPlace'))
            ->whereIn('ActivityTicketPrice', array_column($arrData, 'ActivityTicketPrice'))
            ->whereIn('ActivityImage', array_column($arrData, 'ActivityImage'))
            ->whereIn('ActivityUrl', array_column($arrData, 'ActivityUrl'))
            ->whereIn('ActivityEnter', array_column($arrData, 'ActivityEnter'))
            ->select('ActivityName', 'ActivityTime', 'ActivityTicket', 'ActivityPlace', 'ActivityTicketPrice', 'ActivityImage', 'ActivityUrl', 'ActivityEnter')
            ->get();

        $ActCheckarr = json_decode($ActCheck, true);
        $diff = array_diff(array_map('serialize', $arrData), array_map('serialize', $ActCheckarr));
        $result = array_map('unserialize', $diff);

        openData::insert($result);
        return redirect('/');
    }

}

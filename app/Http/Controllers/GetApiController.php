<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;
// use Illuminate\Http\Request;
use App\Models\openData;
use Illuminate\Support\Facades\Http;

class GetApiController extends Controller
{
    //

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
                // 'limit' => 10, //抓取幾筆
            ]);
        $Activity = json_decode($response->body());
        $ActivityTime = '活動展演(起訖)';
        $arrData = [];
        foreach ($Activity as $act) {

            // 檢驗是否重複再寫入資料庫
            $ActCheck = openData::where([
                ['ActivityName', $act->活動名稱],
                ['ActivityTime', $act->$ActivityTime],
                ['ActivityTicket', $act->活動售票與否],
                ['ActivityPlace', $act->地點],
                ['ActivityTicketPrice', $act->票價],
                ['ActivityImage', $act->相關圖片],
                ['ActivityUrl', $act->活動網址],
                ['ActivityEnter', $act->入場方式],
            ])->first();

            if (!$ActCheck) {
                array_push($arrData, [
                    'ActivityName' => $act->活動名稱,
                    'ActivityTime' => $act->$ActivityTime,
                    'ActivityTicket' => $act->活動售票與否,
                    'ActivityPlace' => $act->地點,
                    'ActivityTicketPrice' => $act->票價,
                    'ActivityImage' => $act->相關圖片,
                    'ActivityUrl' => $act->活動網址,
                    'ActivityEnter' => $act->入場方式,
                ]
                );
            }
        }
        openData::insert($arrData);
        return redirect('/');

    }

}

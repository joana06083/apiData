<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;
// use Illuminate\Http\Request;
use App\Models\openData;
use Illuminate\Support\Facades\Http;

class GetApiController extends Controller
{
    //
    public function saveApiData()
    {
        $response = Http::get(
            'https://datacenter.taichung.gov.tw/swagger/OpenData/c6abbb99-b617-4379-8562-4ab115e91ead',
            [
                'operationId' => 'c6abbb99-b617-4379-8562-4ab115e91ead',
                'limit' => 10,
            ]);
        $Activity = json_decode($response->body());
        $ActivityTime = '活動展演(起訖)';
        foreach ($Activity as $act) {
            $openData = new openData;
            $openData->ActivityName = $act->活動名稱;
            $openData->ActivityTime = $act->$ActivityTime;
            $openData->ActivityTicket = $act->活動售票與否;
            $openData->ActivityPlace = $act->地點;
            $openData->ActivityTicketPrice = $act->票價;
            $openData->ActivityImage = $act->相關圖片;
            $openData->ActivityUrl = $act->活動網址;
            $openData->ActivityEnter = $act->入場方式;

            $openData->save();
        }

        return redirect('/');

    }
    public function index()
    {
        $ActivityInfo = openData::get();
        $data = [
            'ActivityInfo' => $ActivityInfo,
        ];

        return view('index', $data);
    }
}

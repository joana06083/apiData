<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>首頁</title>
</head>
<body>
<div class="container">
    <br>

    <h5>活動資訊</h5>
    <a class="btn btn-secondary" href="/fetch">取得最新資料</a>
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">活動名稱:</th>
            <th scope="col">活動展演(起訖):</th>
            <th scope="col">活動售票與否:</th>
            <th scope="col">地點:</th>
            <th scope="col">票價:</th>
            <th scope="col">相關圖片:</th>
            <th scope="col">活動網址:</th>
            <th scope="col">入場方式:</th>
        </tr>
    </thead>
    @foreach ($ActivityInfo as $act)
    <tbody>
        <tr>
            <th scope="row">{{$act->ActivityNo}}</th>
            <td>{{$act->ActivityName}}</td>
            <td>{{$act->ActivityTime}}</td>
            <td>{{$act->ActivityTicket}}</td>
            <td>{{$act->ActivityPlace}}</td>
            <td>{{$act->ActivityTicketPrice}}</td>
            <td>{{$act->ActivityImage}}</td>
            <td>{{$act->ActivityUrl}}</td>
            <td>{{$act->ActivityEnter}}</td>
        </tr>
    </tbody>
    @endforeach
    </table>


</div>

</body>
</html>

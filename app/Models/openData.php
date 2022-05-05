<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class openData extends Model
{
    protected $table = 'Activity'; // 資料表名稱
    protected $primaryKey = 'ActivityNo'; // 主鍵
    public $timestamps = false; //沒有設定時間 created_at 或 updated_at 的欄位，不需要時間戳記
}

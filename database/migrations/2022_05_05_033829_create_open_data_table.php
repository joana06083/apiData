<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Activity', function (Blueprint $table) {
            $table->bigIncrements('ActivityNo');
            $table->string('ActivityName'); //活動名稱
            $table->string('ActivityTime')->nullable(); //活動展演(起訖)
            $table->string('ActivityTicket')->nullable(); //活動售票與否
            $table->string('ActivityPlace')->nullable(); //地點
            $table->string('ActivityTicketPrice')->nullable(); //票價
            $table->string('ActivityImage')->nullable(); //相關圖片
            $table->string('ActivityUrl')->nullable(); //活動網址
            $table->string('ActivityEnter')->nullable(); //入場方式

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_data');
    }
};

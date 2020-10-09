<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('channel_id')->comment('идентификатор канала');
            $table->bigInteger('game_id')->comment('идентификатор игры');
            $table->string('service')->comment('сервис поставщик стримов');
            $table->integer('viewer_count')->comment('количество смотрящих');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
}

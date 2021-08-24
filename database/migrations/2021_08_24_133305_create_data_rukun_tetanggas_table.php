<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRukunTetanggasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rukun_tetanggas', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp_rukun_tetangga');
            $table->integer('no_rukun_tetangga');
            $table->string('nama_rukun_tetangga');
            $table->string('notel_rukun_tetangga');
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
        Schema::dropIfExists('data_rukun_tetanggas');
    }
}

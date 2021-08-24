<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMasyarakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu_keluarga');
            $table->string('no_ktp_kepala_keluarga');
            $table->string('nama_kepala_keluarga');
            $table->string('pekerjaan_kepala_keluarga');
            $table->bigInteger('penghasilan_kepala_keluarga');
            $table->integer('jumlah_tanggungan');
            $table->string('foto_kepala_keluarga');
            $table->string('notel_kepala_keluarga');
            $table->enum('status_tempat_tinggal', ['MILIK_SENDIRI', 'SEWA']);
            $table->bigInteger('id_rukun_tetangga')->unsigned();
            $table->foreign('id_rukun_tetangga')->references('id')->on('data_rukun_tetanggas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('data_masyarakats');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id()->startingValue(1000000);
            $table->bigInteger('loket_id');
            $table->string('no_antrian');
            $table->string('no_telp')->nullable();
            $table->date('tanggal_booking')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_antrian');
            $table->time('waktu_antrian');
            $table->tinyInteger('jenis_antrian')->default(0);
            $table->tinyInteger('status_antrian')->default(0);
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->bigInteger('urban_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->longText('patokan')->nullable();
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
        Schema::dropIfExists('antrians');
    }
}

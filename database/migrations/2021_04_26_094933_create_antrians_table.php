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
            $table->id();
            $table->bigInteger('loket_id');
            $table->string('no_antrian');
            $table->date('tanggal_booking')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_antrian');
            $table->time('waktu_antrian');
            $table->tinyInteger('jenis_antrian')->default(0);
            $table->tinyInteger('status_antrian')->default(0);
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

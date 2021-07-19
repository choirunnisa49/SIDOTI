<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePabrikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pabrik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pabrik');
            $table->string('kode_pabrik');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('lng');
            $table->string('lat');
            $table->unsignedBigInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('pabrik');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box', function (Blueprint $table) {
            $table->id();
            $table->string('kode_box');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('isi')->nullable();
            $table->integer('max');
            $table->unsignedBigInteger('pabrik_id');
            $table->foreign('pabrik_id')
                ->references('id')
                ->on('pabrik')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('status', ['gudang', 'dijual', 'terjual', 'dikembalikan']);
            $table->unsignedBigInteger('dijual_oleh')->nullable();
            $table->foreign('dijual_oleh')
                ->references('id')
                ->on('toko')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('box');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pabrik_id');
            $table->foreign('pabrik_id')
                ->references('id')
                ->on('pabrik')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('kode_produk');
            $table->string('kode_produksi');
            $table->unsignedBigInteger('box_id');
            $table->foreign('box_id')
                ->references('id')
                ->on('box')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('status', ['gudang', 'dijual', 'terjual', 'dikembalikan']);
            $table->unsignedBigInteger('toko_id')->nullable();
            $table->foreign('toko_id')
                ->references('id')
                ->on('toko')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('dibuat_oleh')->nullable();
            $table->foreign('dibuat_oleh')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}

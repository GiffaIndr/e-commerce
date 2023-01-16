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
        Schema::create('commers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->timestamps();
            $table->string('barang');
            $table->string('jumlah');
            $table->string('image');
            $table->string('harga');
            $table->text('description');
            $table->string('jenis');
            $table->integer('views')->default(1);
            $table->enum('status', ['proses', 'validasi', 'tolak'])->default('proses');
            $table->date('done_time')->nullable();
            $table->enum('tipe', ['jasa', 'produk']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commers');
    }
};

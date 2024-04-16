<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->references('id')->on('tb_outlet')->onDelete('cascade');
            $table->uuid('kode_invoice');
            $table->foreignId('id_member')->references('id')->on('tb_member')->onDelete('cascade');
            $table->datetime('batas_waktu');
            $table->datetime('tgl_bayar')->nullable();
            $table->integer('biaya_tambahan');
            $table->integer('diskon');
            $table->integer('pajak');
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);
            $table->foreignId('id_user')->references('id')->on('tb_user')->onDelete('cascade');
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
        Schema::dropIfExists('tb_transaksi');
    }
}

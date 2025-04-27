<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('kategori');
            $table->integer('jumlah');
            $table->string('kondisi');
            $table->string('lokasi_simpan');
            $table->date('tanggal_masuk');
            $table->softDeletes(); // untuk soft delete
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->dropSoftDeletes();  // Menghapus kolom deleted_at jika rollback
    });
}
};

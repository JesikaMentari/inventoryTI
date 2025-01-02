<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to update the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_barangkeluar', function (Blueprint $table) {
            // Hapus kolom 'bk_tujuan' jika ada
            if (Schema::hasColumn('tbl_barangkeluar', 'bk_tujuan')) {
                $table->dropColumn('bk_tujuan');
            }

            // Tambahkan kolom 'bk_bagian' dan 'bk_namakaryawan' hanya jika belum ada
            if (!Schema::hasColumn('tbl_barangkeluar', 'bk_bagian')) {
                $table->unsignedBigInteger('bk_bagian')->nullable()->after('bk_tanggal');
            }

            if (!Schema::hasColumn('tbl_barangkeluar', 'bk_namakaryawan')) {
                $table->string('bk_namakaryawan')->nullable()->after('bk_bagian');
            }

            // Tambahkan foreign key constraint untuk 'bk_bagian' jika belum ada
            $table->foreign('bk_bagian')->references('id_bagian')->on('tbl_bagian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_barangkeluar', function (Blueprint $table) {
            // Tambahkan kembali kolom 'bk_tujuan' jika belum ada
            if (!Schema::hasColumn('tbl_barangkeluar', 'bk_tujuan')) {
                $table->string('bk_tujuan')->after('bk_tanggal');
            }

            // Hapus foreign key dan kolom 'bk_bagian' dan 'bk_namakaryawan' jika ada
            if (Schema::hasColumn('tbl_barangkeluar', 'bk_bagian')) {
                $table->dropForeign(['bk_bagian']);
                $table->dropColumn('bk_bagian');
            }

            if (Schema::hasColumn('tbl_barangkeluar', 'bk_namakaryawan')) {
                $table->dropColumn('bk_namakaryawan');
            }
        });
    }
};

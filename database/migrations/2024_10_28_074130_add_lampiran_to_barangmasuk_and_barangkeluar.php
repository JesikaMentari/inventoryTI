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
        Schema::table('tbl_barangmasuk', function (Blueprint $table) {
            $table->string('bm_lampiran')->nullable()->after('bm_jumlah'); // Kolom lampiran untuk barang masuk
        });

        Schema::table('tbl_barangkeluar', function (Blueprint $table) {
            $table->string('bk_lampiran')->nullable()->after('bk_jumlah'); // Kolom lampiran untuk barang keluar
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_barangmasuk', function (Blueprint $table) {
            $table->dropColumn('bm_lampiran');
        });

        Schema::table('tbl_barangkeluar', function (Blueprint $table) {
            $table->dropColumn('bk_lampiran');
        });
    }
};

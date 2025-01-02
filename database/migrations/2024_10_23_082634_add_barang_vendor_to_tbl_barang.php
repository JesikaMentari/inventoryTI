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
        Schema::table('tbl_barang', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_barang', 'barang_vendor')) {
                $table->string('barang_vendor')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_barang', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_barang', 'barang_vendor')) {
                $table->dropColumn('barang_vendor');
            }
        });
    }
};

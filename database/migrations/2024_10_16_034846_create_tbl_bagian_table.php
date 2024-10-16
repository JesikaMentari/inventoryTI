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
        if (!Schema::hasTable('tbl_barangkeluar')) {
        Schema::create('tbl_bagian', function (Blueprint $table) {
            $table->id('id_bagian'); // Primary key
            $table->string('nama_bagian'); // Nama bagian
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_bagian');
    }
};

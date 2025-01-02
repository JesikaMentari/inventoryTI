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
        if (!Schema::hasTable('tbl_vendor')) {
        Schema::create('tbl_vendor', function (Blueprint $table): void {
            $table->increments('id_vendor');
            $table->string('vendor_nama');
            $table->string('vendorslug');
            $table->text('vendor_keterangan')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tbl_vendor');
    }
};

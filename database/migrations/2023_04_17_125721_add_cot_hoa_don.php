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
        Schema::table('hoa_don_ban_hangs', function (Blueprint $table) {
            $table->integer('is_xac_nhan')->default(0);
            $table->dateTime('ngay_thanh_toan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoa_don_ban_hangs', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('chi_tiet_hoa_don_nhap_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mon_an');
            $table->string('ten_mon_an');
            $table->double('so_luong_nhap');
            $table->double('don_gia_nhap');
            $table->double('thanh_tien');
            $table->integer('id_hoa_don_nhap_hang');
            $table->text('ghi_chu')->nullable();
            $table->integer('trang_thai')->default(0);
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
        Schema::dropIfExists('chi_tiet_hoa_don_nhap_hangs');
    }
};

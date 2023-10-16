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
        Schema::create('hoa_don_nhap_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nha_cung_cap');
            $table->double('tong_tien_nhap');
            $table->string('ma_hoa_don_nhap_hang');
            $table->date('ngay_nhap_hang')->nullable();
            $table->integer('id_nhan_vien')->default(1);
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
        Schema::dropIfExists('hoa_don_nhap_hangs');
    }
};

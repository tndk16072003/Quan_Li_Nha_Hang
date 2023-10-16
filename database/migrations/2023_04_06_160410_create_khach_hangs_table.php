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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khach');
            $table->string('ho_va_ten');
            $table->string('ho_lot')->nullable();
            $table->string('ten_khach');
            $table->string('so_dien_thoai');
            $table->string('email')->nullable();
            $table->string('ghi_chu')->nullable()->comment("dành để ghi chú thêm thông tin về khách");
            $table->date('ngay_sinh')->nullable();
            $table->integer('id_loai_khach');
            $table->string('ma_so_thue')->nullable()->comment("dành để lưu thông tin khách hàng hay viết hóa đơn");
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
        Schema::dropIfExists('khach_hangs');
    }
};

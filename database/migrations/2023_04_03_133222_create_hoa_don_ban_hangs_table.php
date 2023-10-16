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
        Schema::create('hoa_don_ban_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don_ban_hang');
            $table->double('tong_tien')->default(0);
            $table->double('giam_gia')->default(0);
            $table->integer('id_ban');
            $table->integer('id_khach_hang')->default(0);
            $table->integer('id_nhan_vien')->default(1);
            $table->integer('trang_thai')->default(0)->comment('0: Đang hoạt động, 1: Hóa đơn hoàn thành');
            $table->integer('id_loai_thanh_toan')->default(0)->comment('0: Tiền mặt, còn mấy cái khác hồi tính');
            $table->text('ghi_chu_loai_thanh_toan')->nullable();
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
        Schema::dropIfExists('hoa_don_ban_hangs');
    }
};

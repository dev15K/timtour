<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->nullable();
            $table->string('ma_khach_hang')->nullable();
            $table->string('ten_khach_hang')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('email')->nullable();
            $table->string('mst')->nullable();
            $table->string('dich_vu')->nullable();
            $table->string('nha_cung_cap')->nullable();
            $table->string('tong_tien')->nullable();
            $table->string('nguoi_dai_dien')->nullable();
            $table->string('quoc_tich')->nullable();
            $table->string('cccd')->nullable();
            $table->string('loai_dich_vu')->nullable();
            $table->longText('noi_dung')->nullable();
            $table->string('so_luong')->nullable();
            $table->string('don_gia')->nullable();
            $table->string('thanh_tien')->nullable();
            $table->string('loai_tien')->nullable();
            $table->string('ti_gia')->nullable();
            $table->string('quy_doi')->nullable();
            $table->string('vat')->nullable();
            $table->string('nhan_vien')->nullable();
            $table->string('phai_tra')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items')->nullable();
    }
};

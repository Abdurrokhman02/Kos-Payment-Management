// database/migrations/2025_11_29_000001_create_penyewaan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kamar_id');
            $table->unsignedBigInteger('penghuni_id');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->integer('tenggat_pembayaran')->default(10);
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('kamar_id')->references('id')->on('kamars')->onDelete('cascade');
            $table->foreign('penghuni_id')->references('id')->on('penghuni')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
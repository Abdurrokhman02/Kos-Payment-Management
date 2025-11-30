// database/migrations/2025_11_29_000002_create_pembayaran_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyewaan_id');
            $table->integer('bulan_ke');
            $table->date('tanggal_jatuh_tempo');
            $table->decimal('jumlah', 12, 2);
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['lunas', 'belum_lunas', 'terlambat'])->default('belum_lunas');
            $table->decimal('denda', 12, 2)->default(0);
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('penyewaan_id')->references('id')->on('penyewaan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
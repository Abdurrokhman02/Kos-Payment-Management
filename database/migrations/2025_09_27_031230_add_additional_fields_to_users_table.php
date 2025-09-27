<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nomor_kamar')->nullable()->after('password');
            $table->string('nomor_telepon')->nullable()->after('nomor_kamar');
            $table->text('alamat_asal')->nullable()->after('nomor_telepon');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('alamat_asal');
            $table->string('nomor_darurat')->nullable()->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nomor_kamar', 'nomor_telepon', 'alamat_asal', 'jenis_kelamin', 'nomor_darurat']);
        });
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamars = [
            [
                'nomor_kamar' => 'A1',
                'lantai' => 1,
                'harga' => 1500000,
                'fasilitas' => ['AC', 'Kamar Mandi Dalam', 'Kasur', 'Meja Belajar', 'Lemari'],
                'tersedia' => true
            ],
            [
                'nomor_kamar' => 'A2',
                'lantai' => 1,
                'harga' => 1400000,
                'fasilitas' => ['AC', 'Kamar Mandi Dalam', 'Kasur', 'Meja Belajar'],
                'tersedia' => true
            ],
            [
                'nomor_kamar' => 'A3',
                'lantai' => 1,
                'harga' => 1300000,
                'fasilitas' => ['Kipas Angin', 'Kamar Mandi Dalam', 'Kasur', 'Lemari'],
                'tersedia' => true
            ],
            [
                'nomor_kamar' => 'B1',
                'lantai' => 2,
                'harga' => 1600000,
                'fasilitas' => ['AC', 'Kamar Mandi Dalam', 'Kasur', 'Meja Belajar', 'Lemari', 'Kulkas'],
                'tersedia' => true
            ],
            [
                'nomor_kamar' => 'B2',
                'lantai' => 2,
                'harga' => 1450000,
                'fasilitas' => ['AC', 'Kamar Mandi Dalam', 'Kasur', 'Meja Belajar'],
                'tersedia' => true
            ],
            [
                'nomor_kamar' => 'B3',
                'lantai' => 2,
                'harga' => 1350000,
                'fasilitas' => ['Kipas Angin', 'Kamar Mandi Dalam', 'Kasur', 'Lemari'],
                'tersedia' => true
            ]
        ];

        foreach ($kamars as $kamar) {
            \App\Models\Kamar::create($kamar);
        }
    }
}

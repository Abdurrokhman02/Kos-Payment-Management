<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'lantai',
        'harga',
        'fasilitas',
        'tersedia'
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'tersedia' => 'boolean',
        'harga' => 'decimal:2'
    ];//
}

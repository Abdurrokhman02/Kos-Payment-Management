<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'payment_date',
        'status',
        'created_at',
        'updated_at',
        'amount',
    ];

    protected $casts = [
        'amount' => 'double',
        'payment_date' => 'datetime',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kamar that the payment is for.
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

}
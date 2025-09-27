<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor_kamar',
        'nomor_telepon',
        'alamat_asal',
        'jenis_kelamin',
        'nomor_darurat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the payments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

     /**
     * Get the user's payment status for the current month.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function paymentStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Hanya cek status untuk role 'user'
                if ($this->role !== 'user') {
                    return 'Tidak Berlaku';
                }

                // Ambil tanggal pendaftaran user
                $registrationDate = Carbon::parse($this->created_at);
                
                // Tentukan tanggal jatuh tempo bulan ini
                $dueDate = Carbon::now()->setDay($registrationDate->day);

                // Cek apakah ada pembayaran di bulan ini
                $latestPayment = $this->payments()
                                      ->whereMonth('created_at', Carbon::now()->month)
                                      ->whereYear('created_at', Carbon::now()->year)
                                      ->latest()
                                      ->first();
                
                if ($latestPayment) {
                    return 'Lunas';
                }

                // Jika sudah melewati tanggal jatuh tempo bulan ini dan belum bayar
                if (Carbon::now()->gt($dueDate)) {
                    return 'Belum Lunas';
                }

                // Jika belum jatuh tempo
                return 'Menunggu';
            }
        );
    }
}

<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function collection()
    {
        return $this->payments;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Nomor Kamar',
            'Jumlah',
            'Bulan',
            'Tahun',
            'Status',
            'Tanggal Pembayaran',
            'Dibuat Pada',
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->user->name,
            $payment->user->nomor_kamar,
            'Rp ' . number_format($payment->amount, 0, ',', '.'),
            $payment->month,
            $payment->year,
            $payment->status == 'paid' ? 'Lunas' : 'Belum Lunas',
            $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i') : '-',
            $payment->created_at->format('d/m/Y H:i'),
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Export payments to Excel
     */
    public function export()
    {
        $payments = Payment::with('user')
            ->orderBy('payment_date', 'desc')
            ->get();
            
        $filename = 'laporan-pembayaran-' . Carbon::now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new PaymentsExport($payments), $filename);
    }
}

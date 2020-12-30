<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    //show home
    public function index()
    {
        $income = formatRupiah(Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total'));
        $sales = Transaction::count();
        $items = Transaction::orderBy('id', 'DESC')->take(5)->get();

        $pie = [
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count()
        ];
        return view('pages.dashboard', [
            'income' => $income,
            'sales' => $sales,
            'items' => $items,
            'pie' => $pie
        ]);
    }
}

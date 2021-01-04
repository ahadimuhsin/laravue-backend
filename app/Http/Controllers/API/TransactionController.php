<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    //
    public function get_data(Request $request, $id)
    {
        $product = Transaction::with(['details.product'])->find($id);

        if($product){
            return ResponseFormatter::success($product, 'Informasi data transaksi berhasil');
        }
        else{
            return
            ResponseFormatter::error(null, 'Data transaksi tidak ada', 404);
        }
    }
}

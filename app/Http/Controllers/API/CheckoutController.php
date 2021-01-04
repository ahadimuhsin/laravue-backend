<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Requests\API\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function checkout(CheckoutRequest $request)
    {
        //mengambil semua inputan kecuali transaction_details
        $data = $request->except('transaction_details');
        //simpan uuid sesuai format
        $data['uuid'] = 'TRX'.mt_rand(10000, 99999).mt_rand(100,999);

        $transactions = Transaction::create($data);
        //tiap transaction_details, disimpan ke dalam details
        //dan diisi ke tabel transaction_details
        foreach($request->transaction_details as $product)
        {
            $details[] = new TransactionDetail([
                'transaction_id' => $transactions->id,
                'product_id' => $product
            ]);

            //mengurangi quantity product apabila transaksi berhasil
            Product::find($product)->decrement('quantity');
        }
        //simpan data relasi ke tabel transaction_details
        $transactions->details()->saveMany($details);

        //return response
        return ResponseFormatter::success($transactions, 'Transaksi Berhasil');
    }
}

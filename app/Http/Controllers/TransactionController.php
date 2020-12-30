<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transaction::paginate(10);

        return view('pages.transactions.index', ["items" => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Transaction::with('details.product')->findOrFail($id);

        return view('pages.transactions.show', ["item" => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = Transaction::findOrFail($id);

        return view('pages.transactions.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        $data = $request->all();

        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transactions.index')->with(
            ['success' => 'Data ' . $item->uuid . ' berhasil diubah!']
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()->route('transactions.index')->with(
            ['success' => 'Data berhasil dihapus']
        );
    }

    public function changeStatus (Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'transaction_status' => $request->status
        ]);

        return redirect()->route('transactions.index')->with([
            'success' => 'Status transaksi '.$transaction->uuid.' berhasil diubah'
        ]);
    }
}

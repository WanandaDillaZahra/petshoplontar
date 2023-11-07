<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsM;
use App\Models\ProductsM;
use PDF;

class transactionsPDF extends Controller
{
    // public function pdf2($id) {
    //     $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
    //         ->join('products', 'products.id', '=', 'transactions.id_produk')
    //         ->where('transactions.id', $id)
    //         ->first();
        
    //     if ($transactionsM) {
    //         $pdf = PDF::loadview('transactions_pdf2', ['transactions' => $transactions]);
    //         return $pdf->stream('transactions_' . $id . '.pdf');
    //     } else{
    //         return response('Data Transaksi Tidak Ditemukan', 404);
    //     }
    // }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionsM;
use App\Models\ProductsM;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionsC extends Controller
{
    public function index(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Transaksi',
        ]);

        $query = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
            ->join('products', 'products.id', '=', 'transactions.id_produk')
            ->orderBy('transactions.created_at', 'desc');

        if ($request->filled('start_date')) {
            $query->whereDate('products.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('products.created_at', '<=', $request->end_date);
        }

        $transactionsM = $query->paginate(5);

        $subtitle = "Daftar Transaksi Produk";

        return view('transactions_index', compact('subtitle', 'transactionsM'));
    }

    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Tambah Data Transaksi',
        ]);

        $subtitle = "Tambah Data Transaksi Produk";
        $productsM = ProductsM::all();

        return view('transactions_create', compact('subtitle', 'productsM'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);

        $product = ProductsM::find($request->input('id_produk'));

        if (!$product) {
            return redirect()->route('transactions.create')->with('error', 'Produk tidak ditemukan');
        }

        $transactions = new TransactionsM;
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->uang_kembali = $request->input('uang_bayar') - $product->harga_produk;
        $transactions->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Edit Data Transaksi',
        ]);

        $subtitle = "Edit Data Transaksi Produk";
        $transactions = TransactionsM::find($id);

        if (!$transactions) {
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }

        $productsM = ProductsM::all();

        return view('transactions_edit', compact('subtitle', 'productsM', 'transactions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);

        $transactions = TransactionsM::find($id);

        if (!$transactions) {
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }

        $product = ProductsM::find($request->input('id_produk'));

        if (!$product) {
            return redirect()->route('transactions.edit', $id)->with('error', 'Produk tidak ditemukan');
        }

        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->uang_kembali = $request->input('uang_bayar') - $product->harga_produk;
        $transactions->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Diperbaharui');
    }

    public function delete($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Transaksi',
        ]);

        $transactions = TransactionsM::find($id);

        if (!$transactions) {
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }

        $transactions->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Dihapus');
    }

    public function pdf()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak PDF',
        ]);

        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
            ->join('products', 'products.id', '=', 'transactions.id_produk')
            ->get();

        $pdf = PDF::loadView('transactions_pdf', ['transactionsM' => $transactionsM]);

        return $pdf->stream('transactions.pdf');
    }

    public function pdf2($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk',
        ]);

        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
            ->join('products', 'products.id', '=', 'transactions.id_produk')
            ->where('transactions.id', $id)
            ->first();

        if (!$transactionsM) {
            return response('Data transaksi tidak ditemukan', 404);
        }

        $pdf = PDF::loadView('transactions_pdf2', ['transactionsM' => $transactionsM]);

        return $pdf->stream('transactions.pdf2' . $id . '.pdf');
    }

    public function pertanggal(Request $request)
    {
        // Gunakan tanggal yang diterima sesuai kebutuhan
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        // dd(["tanggal awal: ".$tgl_awal, "tanggal akhir: ".$tgl_akhir]);

        // Lakukan pemrosesan data dengan menggabungkan data dari tabel Transactions dan Products
        $transactions = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_tran', 'transactions.created_at AS tg')
            ->join('products', 'products.id', '=', 'transactions.id_produk')
            ->whereBetween('transactions.created_at', [$start_date, $end_date])
            ->get();

        // Gunakan PDF::loadView untuk membuat tampilan PDF
        $pdf = PDF::loadView('transactions_pertanggal', ['transactions' => $transactions]);

        // Gunakan stream() untuk menampilkan atau mengunduh PDF
        return $pdf->stream('stgl.pdf');
    }
    
}

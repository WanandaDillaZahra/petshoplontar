<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsM;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProductsC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Produk'
        ]);

        $productsM = ProductsM::search(request('search'))->paginate(10);
        $vcari = request('search');
        $subtitle = "Daftar Produk";
        return view('products_index', compact('productsM', 'vcari','subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Tambah Data Produk'
        ]);
        $subtitle = "Tambah Produk";
        return view('products_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
        ]);

        ProductsM::create($request->post());
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Ditambahkan');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Edit Data Produk'
        ]);
        $subtitle = "Edit Data Produk";
        $data = ProductsM::find($id);
        return view('products_edit', compact('data', 'subtitle'));
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
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Berhasil Perbarui Data Produk'
        ]);
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
        ]);
        $data = request()->except(['_token', '_method', 'submit']);

        ProductsM::where('id', $id)->update($data);
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Produk'
        ]);
        ProductsM::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Dihapus');
    }

    public function pdf(){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak PDF'
        ]);
        $ProductsM = ProductsM::all();
        //return view('products_pdf', compact('productsM'));
         $pdf = PDF::loadview('products_pdf', ['productsM' => $ProductsM]);
         return $pdf->stream('products.pdf'); 
    }
}
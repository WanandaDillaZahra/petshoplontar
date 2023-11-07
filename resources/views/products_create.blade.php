@extends('adminlte')
 @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PetShop Lontar | Tambah Data Produk</h1>
          </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Produk</h3>
        </div>
        
        <!-- /.card-body -->
        <div class="card-body">
          <a href="{{route('products.index')}}" class="btn btn-outline-info">Kembali</a>
          <br><br>
           <form action="{{route('products.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label >Nama Produk</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="Nama Produk">
                @error('nama_produk')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Harga Produk</label>
                <input name="harga_produk" type="number" class="form-control" placeholder="Harga Produk">
                @error('harga_produk')
                <p>{{$message}}</p>     
                @enderror
                <br>
                <input type="submit" name="submit"class="btn btn-dark" value="Simpan"/>
            </div>
         
        </form>
    </div>
      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  @endsection('content')
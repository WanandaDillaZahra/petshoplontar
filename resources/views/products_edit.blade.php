@extends('adminlte')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>PetShop Lontar | Edit Data Produk</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Data Produk</h3>
  
          </div>
          <div class="card-body">
            <a href="{{route('products.index')}}" class="btn btn-outline-info">Kembali</a>
            <br><br>
            <form action="{{ route('products.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Produk</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="" value="{{ $data->nama_produk }}">
                @error('nama_produk')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Harga Produk</label>
                <input name="harga_produk" type="number" class="form-control" placeholder="" value="{{ $data->harga_produk }}">
                @error('harga_produk')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit"class="btn btn-dark" value="Simpan"/>
            </form>
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
@endsection
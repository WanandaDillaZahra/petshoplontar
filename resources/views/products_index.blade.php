@extends('adminlte')
@section('content')

   <!-- Content Header (Page header) -->
   <title>Petshop Lontar | {{ $subtitle }}</title>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>PetShop Lontar | Data Produk</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Produk</h3>
          </div>
          <div class="card-body">
            @if (Auth::user()->role == 'Owner' || Auth::user()->role == 'Admin')
            <form action="{{ route('products.index') }}" method="get">
                <div class="input-group">
                    <input type="text" type="search" name="search" class="form-control" placeholder="Masukan Nama Products" value="{{ $vcari }}">
                    <mr-1>
                    <button type="submit" class="btn btn-primary shadow">Cari</button>
                    <a href="{{ route('products.index') }}">
                        <button type="button" class="btn btn-danger shadow">Reset</button>
                    </a>
                </div>
            </form>
            <br>
        @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            @if (Auth::user()->role == 'Admin')
                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah</a> 
            @endif

            @if ( Auth::user()->role == 'Admin' || Auth::user()->role == 'Owner')
                <a href="{{ url('products/pdf') }}" class="btn btn-warning">Unduh PDF</a>
                <br><br>
            @endif
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Harga Produk</th>
                    @if (Auth::user()->role == 'Owner' || Auth::user()->role == 'Kasir')
                         <th class="text-center">Tanggal Masuk</th>
                    @endif
                    @if (Auth::user()->role == 'Admin')
                        <th class="text-center">Aksi</th>
                    @endif
                  </tr>
                </thead>
                @if (count($productsM) > 0)
                @foreach ($productsM as $data)
                <tr>
                  <td>{{  $data->nama_produk  }}</td>
                  <td>{{  $data->harga_produk  }}</td>
                  @if (Auth::user()->role == 'Owner' || Auth::user()->role == 'Kasir')
                    <td class="text-center">{{ $data->created_at }}</td>
                  @endif
                  @if (Auth::user()->role == 'Admin')
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('products.edit', $data->id) }}" class="btn btn-xs btn-outline-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                      <form action="{{ route('products.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-xs btn-outline-danger" style="margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Data??')">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form> 
                    </div>
                  </td>
                  @endif
                </tr>
                @endforeach
                @else
                <tr>
                  <td style="text-align: center; vertical-align: middle;"> Data Tidak Ditemukan</td>
                </tr>
                @endif
              </table>
              <br>
              {!! $productsM->withQueryString()->links('pagination::bootstrap-5') !!}
          </div>
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
@endsection

@extends('adminlte')
@section('content')

    <!-- Page title -->
    <title>Petshop Lontar | {{ $subtitle }}</title>

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PetShop Lontar | Transaksi</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Transaksi</h3>
            </div>

            <div class="card-body">
                {{-- @if (Auth::user()->role == 'Kasir' || Auth::user()->role == 'Admin')
                    <form action="{{ route('transactions.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" type="search" name="search" class="form-control" placeholder="Masukan Nama Products" value="{{ $vcari }}">
                            <mr-1>
                            <button type="submit" class="btn btn-primary shadow">Cari</button>
                            <a href="{{ route('transactions.index') }}">
                                <button type="button" class="btn btn-danger shadow">Reset</button>
                            </a>
                        </div>
                    </form>
                    <br>
                @endif --}}

                @if (Auth::user()->role == 'Owner' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir')
                    <form action="{{ route('transactions.index') }}" method="get" class="form-inline">
                        
                        <div class="form-group mx-2">
                            <label for="start_date" class="mr-2">Tanggal Awal:</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="form-group mx-2">
                            <label for="end_date" class="mr-2">Tanggal Akhir:</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> 
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-danger">
                            <i class="fas fa-undo"></i> 
                        </a>
                    </form>    
                    <br>
                @endif
                
                @if (Auth::user()->role == 'Kasir')
                <a href="{{ route('transactions.create') }}" class="btn btn-success">Tambah</a>
                <br><br>
                @endif

                @if (Auth::user()->role == 'Admin')
                <a href="{{ route('transactions.create') }}" class="btn btn-success">Tambah</a>
                <a href="{{ url('transactions/pdf') }}" class="btn btn-warning">Unduh PDF</a> 
                <br><br>
                @endif

                @if (Auth::user()->role == 'Owner')
                <a href="{{ url('transactions/pdf') }}" class="btn btn-warning">Unduh PDF</a> 
                <br><br>
                @endif

                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Nomor Unik</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga Produk</th>
                            <th class="text-center">Uang Bayar</th>
                            <th class="text-center">Uang Kembali</th>
                            <th class="text-center">Tanggal</th>
                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    @if (count($transactionsM) > 0)
                        @foreach ($transactionsM as $data)
                            <tr>
                                <td>{{ $data->nomor_unik }}</td>
                                <td>{{ $data->nama_pelanggan }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td>{{ $data->harga_produk }}</td>
                                <td>{{ $data->uang_bayar }}</td>
                                <td>{{ $data->uang_kembali }}</td>
                                <td>{{ $data->created_at }}</td>
                                @if (Auth::user()->role !== 'Owner')
                                <td>
                                    @if (Auth::user()->role == 'Kasir')
                                        <a href="{{ route('transactions.pdf2', ['id' => $data->id_trans]) }}"
                                           class="btn btn-xs btn-outline-warning">
                                            <i class="fas fa-solid fa-print"></i>
                                        </a>
                                    @endif

                                    @if (Auth::user()->role == 'Admin')
                                        <a href="{{ route('transactions.edit', $data->id_trans) }}"
                                           class="btn btn-xs btn-outline-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('transactions.delete', $data->id_trans) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Konfirmasi Hapus Data??')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                          <td colspan="8" style="text-align: center; vertical-align: middle;"> Data Tidak Ditemukan</td>
                        </tr>
                    @endif
                </table>
                <br>
            {!! $transactionsM->withQueryString()->links('pagination::bootstrap-5')!!}
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

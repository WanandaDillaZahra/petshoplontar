@extends('adminlte')
@section('content')

   <!-- Content Header (Page header) -->
   <title>Petshop Lontar | {{ $subtitle }}</title>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>PetShop Lontar | Log</h1>
            </div>
            {{-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Log</li>
              </ol>
          </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Log</h3>

          </div>
          <div class="card-body">
            {{-- @if (Auth::user()->role == 'Admin')
            <form action="{{ route('log.index') }}" method="get">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Masukan Tanggal" value="{{ $vcari }}">
                    <mr-1>
                    <button type="submit" class="btn btn-primary shadow">Cari</button>
                    <a href="{{ route('log.index') }}">
                        <button type="button" class="btn btn-danger shadow">Reset</button>
                    </a>
                </div>
            </form>
            <br>
        @endif  --}}

            @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            {{-- <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Data</a> --}}
            {{-- <a href="{{ url('products/pdf') }}" class="btn btn-warning">Unduh PDF</a> --}}
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Aktivitas</th>
                    <th class="text-center">Tanggal & Waktu</th>
                  </tr>
                </thead>
                @if (count($logM) > 0)
                @foreach ($logM as $log)
                <tr>
                  <td>{{  $log->name  }}</td>
                  <td>{{  $log->activity  }}</td>
                  <td>{{  $log->created_at  }}</td>
                  
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="3">Data Tidak Ditemukan</td>
                </tr>
                @endif
              </table>
              <br>
              {!! $logM->withQueryString()->links('pagination::bootstrap-5')  !!}
          </div>
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
@endsection
@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2 style="color: white;">Cetak Pertanggal</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Pertanggal Transactions</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Print Pertanggal</h3>
      <a href="{{ route('transactions.index') }}" 
      class="btn btn-info">Kembali</a>
      <br>
      {{-- <form action="{{ route('transactions.pertanggal') }}" method="GET">
         --}}
         <form action="{{ route('transactions.pertanggal', ['start_date' => '2023-01-01', 'end_date' => '2023-12-31']) }}" method="GET">
          <div class="form-group">
              <label>Tanggal Awal</label>
              <input name="start_date" type="date" class="form-control" style="border: 1px solid rgb(88, 88, 88);">
              @error('start_date')
              <p>{{ $message }}</p>
              @enderror
          </div>
          <div class="form-group">
              <label>Tanggal Akhir</label>
              <input name="end_date" type="date" class="form-control" style="border: 1px solid rgb(88, 88, 88);">
              @error('end_date')
              <p>{{ $message }}</p>
              @enderror
          </div>
          <h6>*Tanggal Akhir tidak masuk data</h6>
          <button type="submit" class="btn btn-success">Tampilkan Data</button>
        </form>
         {{-- </form>     --}}
    <!-- /.card-body -->
    <!-- /.card-footer-->
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection
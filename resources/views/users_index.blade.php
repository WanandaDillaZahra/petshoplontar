@extends('adminlte')
 @section('content')

    <!-- Content Header (Page header) -->
    <title>Petshop Lontar | {{ $subtitle }}</title>
  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Petshop Lontar | User</h1>
          </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Pengguna</h3>

      </div>
      <div class="card-body">
        @if (Auth::user()->role == 'Admin')
        <form action="{{ route('users.index') }}" method="get">
          <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Masukan Nama Pengguna" value="{{ $vcari }}">
            <mr-1>
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('users.index') }}">
              <button type="button" class="btn btn-danger">Reset</button>
            </a>
          </div>
          </form>
        <br>
        @endif
          
          @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            @if (Auth::user()->role == 'Admin')
              <a href="{{ route('users.create') }}" class="btn btn-success shadow">Tambah</a>
              <a href="{{ url('users/pdf') }}" class="btn btn-warning shadow">Unduh PDF</a>
              <br><br>
            @endif
          
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th class="text-center">Username</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Role</th>
                <th class="text-center">Aksi</th>
              
              </tr>
            </thead>
            @if(count($user) >0) 
            @foreach($user as $users)
            <tr>
                <td>{{ $users->username }}</td>
                <td>{{ $users->name}}</td>
                <td>{{ $users->role}}</td>

                <td>
                  <form action="{{ route('users.destroy', $users->id) }}" method="POST">
                    {{-- <a href="{{ route('users.changepassword', $users->id)}}" class="btn btn-xs btn-success">
                        <i class="fas fa-lock"></i> Ganti Kata Sandi
                    </a> --}}
                
                    <a href="{{ route('users.edit', $users->id) }}" class="btn btn-xs btn-outline-warning">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                
                    @csrf
                    @method('delete')
                    
                    <button type="submit" class="btn btn-xs btn-outline-danger" onclick="return confirm('Konfirmasi Hapus Data??');">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                    <a href="{{ route('users.changepassword', $users->id)}}" class="btn btn-xs btn-outline-success">
                      <i class="fas fa-lock"></i>
                  </a>
                </form>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4" style="text-align: center; vertical-align: middle;"> Data Tidak Ditemukan</td>
        </tr>   
        @endif
           </table>
           {{-- <br>
           {!! $user->withQueryString()->links('pagination::bootstrap-5')!!}  --}}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  @endsection('content')
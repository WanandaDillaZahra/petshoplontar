@extends('adminlte')
 @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Petshop Lontar | Edit User</h1>
          </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data User</h3>
        </div>


        <!-- /.card-body -->
        <div class="card-body">
          <a href="{{route('users.index')}}" class="btn btn-outline-info">Kembali</a>
          <br><br>
           <form action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label >Username</label>
                <input name="username" type="text" class="form-control" placeholder="", value="{{$user->username}}" readonly>
                @error('username')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
              <label >Nama</label>
              <input name="name" type="text" class="form-control" placeholder="", value="{{$user->name}}">
              @error('name')
              <p>{{$message}}</p>     
              @enderror
            </div>
            <div>
              <label>Role</label>
              <select name="role" class="form-control">
                  <option>-Pilih Role-</option>
                  @if($user->role == 'Admin') 
                  <option value="Admin" selected>Admin</option>
                  <option value="Kasir" >Kasir</option>
                  <option value="Owner" >Owner</option>
                  @endif
                  @if($user->role == 'Kasir') 
                  <option value="Admin" >Admin</option>
                  <option value="Kasir" selected>Kasir</option>
                  <option value="Owner" >Owner</option>
                  @endif
                  @if($user->role == 'Owner') 
                  <option value="Admin" >Admin</option>
                  <option value="Kasir" >Kasir</option>
                  <option value="Owner" selected>Owner</option>
                  @endif
              </select>
              @error('role')
              <p>{{ $message }}</p>
              @enderror
          </div>
            <br>
        
      <input type="submit" name="submit"class="btn btn-dark" value="Simpan"/>

    </form>
      </div>

      
      <!-- /.card -->

    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->
  @endsection('content')
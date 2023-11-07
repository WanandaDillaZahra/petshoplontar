<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PetShop Lontar | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-dark">
    <div class="card-header text-center" style="display: flex; justify-content: center; align-items: center;">
      <img src="../../dist/img/kitty.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8" width="50" height="50">
      <a href="../../index2.html" class="h1" style="margin-left: 10px;"><b>PetShop</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      @if(session('success'))
      <p class="alert alert-success">{{ session('success') }}</p>
      @endif
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif

      <form action="{{ route('login.action') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="show-password-checkbox">
              <label class="form-check-label" for="show-password-checkbox">Lihat Kata Sandi</label>
            </div>
          </div>
          <div class="col-4" style="margin-top: 28px;">
            <button type="submit" class="btn btn-dark btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <!-- /.social-auth-links -->

      {{-- <p class="mb-0">
        <a href="{{ url('register')}}" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js')}}"></script>
<!-- Custom JavaScript for Password Toggle -->
<script>
  const passwordInput = document.getElementById('password');
  const showPasswordCheckbox = document.getElementById('show-password-checkbox');

  showPasswordCheckbox.addEventListener('change', function() {
    if (showPasswordCheckbox.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
</body>
</html>

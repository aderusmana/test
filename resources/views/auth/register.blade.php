<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('assets/dist/img/logoo.png') }}" class="img-fluid" alt="">
            </div>
            <div class="card-body">
                <h4 class="text-center"><b>Elisoft Technology</b> </h4>
                <p class="login-box-msg">Register</p>
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach

                @endif
                <form action="{{ route('register.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password Confirmation"
                            name="password_confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <img class="img-preview img-fluid" width="300px">
                        <input type="file" class="form-control" name="avatar" id="avatar"
                            placeholder="Upload File">
                    </div>
                    <!-- /.col -->
                    <div class="text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </form>
                <div class="text-center mt-2 mb-3">
                    <a href="{{ route('login') }}" class="btn btn-block btn-danger"> Login
                    </a>
                </div>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
</body>

</html>

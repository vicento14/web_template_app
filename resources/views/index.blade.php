<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="web template" />
    <meta name="keywords" content="web, template" />

    <title>Web Template</title>

    <link rel="icon" type="image/x-icon" href="{{asset('/dist/img/logo.ico')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('/dist/css/font.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{asset('/dist/img/logo.png')}}" style="height:150px;">
            <h2><b>Web<br>Template</b></h2>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Sign in to start your session</b></p>

                <form action="{{ route('login/sign-in') }}" method="POST" id="login_form">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                autocomplete="off" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn bg-primary btn-block" name="Login"
                                value="login">Login</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="button" href="#" target="_blank" class="btn bg-danger btn-block" id="wi">Work
                                Instruction</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <center>
                                <a href="{{ route('viewer') }}">Go Back to Home Page</a>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/dist/js/adminlte.min.js')}}"></script>

    <script type="text/javascript">
        // DOMContentLoaded function
        document.addEventListener("DOMContentLoaded", () => {
            var sign_in_failed = "{{ $sign_in_failed }}";
            if (sign_in_failed == 'failed') {
                alert("Sign In Failed. Maybe an incorrect credential or account not found");
            }
        });
    </script>

</body>

</html>

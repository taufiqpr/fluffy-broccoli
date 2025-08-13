<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ url('adminkit/src/img/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Log In</title>

    <link rel="stylesheet" href="{{url ('adminkit/static/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">



                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-3">
                                    <h1 class="h2">Welcome back</h1>
                                    <p class="lead">
                                        Sign in to your account to continue
                                    </p>
                                </div>
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ url('adminkit/static/img/avatars/photo.jpg') }}" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form action="{{ route('login-proses') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                                        </div>
                                        @error('email')
                                        <small>{{ $message }}</small>
                                        @enderror
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="position-relative">
                                                <input id="password" class="form-control form-control-lg pe-5" type="password" name="password" placeholder="Enter your password" />
                                                <i id="password-icon" class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; font-size: 1.2rem;" onclick="togglePasswordVisibility()"></i>
                                            </div>
                                            <small>
                                                <a href="index.html">Forgot password?</a>
                                            </small>
                                        </div>
                                        @error('password')
                                        <small>{{ $message }}</small>
                                        @enderror
                                        <div>
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                                <span class="form-check-label">
                                                    Remember me next time
                                                </span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3 mb-1">
                                            <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                            <div class="d-flex align-items-center my-4">
                                                <hr class="flex-grow-1" style="border: 0; border-top: 1px solid #ccc;" />
                                                <span class="mx-2 text-muted">Atau</span>
                                                <hr class="flex-grow-1" style="border: 0; border-top: 1px solid #ccc;" />
                                            </div>
                                            <div class="text-center mt-4">
                                                <a href="{{ route('google.redirect') }}" class="btn btn-outline-danger d-inline-flex align-items-center justify-content-center">
                                                    <i class="bi bi-google me-2"></i> Login with Google
                                                </a>
                                            </div>
                                            <div class="text-center mt-4">
                                                <a href="" class="btn btn-outline-primary d-inline-flex align-items-center justify-content-center">
                                                    <i class="bi bi-facebook me-2"></i> Login with Facebook
                                                </a>
                                            </div>
                                            <div class="mt-4">
                                                <span class="text-muted">Don't have an account?</span>
                                                <a href="{{ route('register') }}" class="text-decoration-none">Create Account</a>
                                            </div>
                                            

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ url('adminkit/src/js/app.js') }}"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($message = Session::get('succes'))
    <script>
        Swal.fire('{{ $message }}');
    </script>
    @endif

    @if($message = Session::get('failed'))
    <script>
        Swal.fire('{{ $message }}');
    </script>
    @endif

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DBYS | Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">


    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
         button {
            background-color: #0d6efd !important;
         }
        .text-color{
            color: #0d6efd;
        }
        svg{
            cursor: pointer;
            padding: 4px;
        }
     .form-control.is-invalid,
    .was-validated .form-control:invalid {
        border-color: initial;
        padding-right: initial;
        background-image: none;
        background-repeat: initial;
        background-position: initial;
        background-size: initial;
    }
    </style>
    
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">DBYS</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label text-sm">Username</label>
                                            
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username"
                                                value="{{ old('username') }}"
                                                autocomplete="username" required>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color:Red">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                     <div class="col-12">
                                        <label for="yourPassword" class="form-label text-sm">Password</label>
                                        <div class="relative">
                                            <input class="w-full text-lg py-2 border-b border-gray-300 form-control  @error('password') is-invalid @enderror" type="password"  id="password"  name="password" required autocomplete="current-password">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex text-sm leading-5" style="margin-top: 12px;">
                                            <svg class="h-6 text-gray-700" fill="none" id="view" xmlns="http://www.w3.org/2000/svg"
                                            viewbox="0 0 576 512">
                                            <path fill="currentColor"
                                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                            </path>
                                            </svg>
            
                                            <svg class="h-6 text-gray-700" fill="none" id="hide" style="display:none;"  xmlns="http://www.w3.org/2000/svg"
                                            viewbox="0 0 640 512">
                                            <path fill="currentColor"
                                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                            </path>
                                            </svg>
                                            </div>
                                            </div>
                                              @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color:Red">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                           
                                        </div>
                                    

                                        <div class="col-12">
                                                @if (Route::has('password.request'))
                                                <a class="text-xs font-display font-semibold text-color" href="{{ route('password.request') }}">
                                                    Forgot Password?
                                                </a>
                                                @endif
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 btn-color" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a class="text-color" href="{{ route('register') }}">Create an account</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    {{-- <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
        $("#view").on('click', function(event) {
            event.preventDefault();
            $('#password').removeAttr('type', 'password');
            $('#password input').attr('type', 'text');
            $('#hide').removeAttr('style');
            $('#view').attr('style','display:none');
        });
        $("#hide").on('click', function(event) {
            event.preventDefault();
            $('#password').removeAttr('type', 'text');
            $('#password').attr('type', 'password');
            $('#view').removeAttr('style');
            $('#hide').attr('style','display:none');
        });
    });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DBYS | Reset password</title>
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
        .btn-color{
            color:black;
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
                                        <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                        <p class="text-center small"></p>
                                    </div>

                                    <form method="POST" action="{{ route('password.email') }}" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label text-sm">Email Address</label>
                                            <input type="email" name="email" class="w-full text-lg py-2 border-b border-gray-300 form-control  @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email') }}"
                                            autocomplete="email" autofocus required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror   
                                        </div>
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                       @endif
                                       <br>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 " type="submit">Submit</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account <a class="text-color" href="{{  route('login')  }}">Sign In</a></p>
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
   <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>

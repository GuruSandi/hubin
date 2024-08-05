<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIPAPII</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        /* Custom CSS for login page */

        /* Centering the container vertically */
        .container {
            display: flex;
            align-items: center;
            min-height: 100vh;
        }

        /* Background color for left column */
        .left-column {
            background-color: #e7f3ff;
            padding: 20px;
        }

        

        /* Logo styling */
        .logo {
            max-width: 100%;
            height: auto;
        }

        /* Form styling */
        .form-container {
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .container {
                flex-direction: column;
            }
        }
        label,
        input,
        button {
            font-family: 'Open Sans', sans-serif;
            /* Ganti 'Roboto' dengan nama font yang Anda inginkan */
        }
        input,
        button {
            /* Ganti 'Roboto' dengan nama font yang Anda inginkan */
            border-radius: 20%;
        }
        .btn-custom {
            background-color: #080761;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            /* Transisi untuk efek hover */
        }

        .btn-custom:hover {
            background-color: #0a0942;
            /* Warna latar belakang berubah saat tombol dihover */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="shadow">
            <div class="row">
                <div class="left-column col-md-6">
                    <div class="mx-auto mt-5">
                        <img src="{{ asset('img/logo.png') }}" class="logo mx-auto" alt="Logo">
                        {{-- <img src="{{ asset('img/smea.png') }}" alt="Logo" width="100px" height="100px"> --}}                     
                    </div>
                </div>
                <div class="right-column col-md-6">
                    <div class="form-container mx-auto" >
                        <h2 class="fw-bold mt-5" style="color: #080761">SIPAPII<br>SMK Negeri 2 Sukabumi</h2>
                        <form action="{{ route('postlogin') }}" class="form-group mt-5" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-lg mb-3" required name="username" >
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg mb-3" required name="password">
                            @if (Session::has('status'))
                                <div class="mt-3 mb-3 text-danger">{{ Session::get('status') }}</div>
                            @endif
                            <button class="btn btn-lg form-control form-control-lg mb-3 text-white"
                                style="background-color: #080761;">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('img/logohubin.jpeg') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logohubin.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('login/style.css') }}">
    <title>SIPAPII</title>
    
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
        <div class="bubbles"></div>
            
            <form action="{{ route('postlogin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 style="color: #080761">SIPAPII</h1>
                <h3 style="color: #080761">SMK Negeri 2 Sukabumi</h3>
                <div class="social-icons">
                    <p>Sistem Informasi Praktik Anak Pada Instansi dan Industri</p>
                </div>
                <span style="margin-bottom: 5px">Silahkan masukan Username dan Password Anda</span>
                <input type="text" placeholder="Username" required name="username">
                <input type="password" placeholder="Password" required name="password">
                @if (Session::has('status'))
                    <div style="margin-top: 5px; margin-bottom: 5px; color: red">
                        <span>{{ Session::get('status') }}</span>
                    </div>
                @endif
                <button type="submit">Sign In</button>
            </form>
        </div>
        
        <!-- Add the hide-on-mobile class to elements you want to hide on mobile devices -->
        <div class="toggle-container hide-on-mobile">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <img src="{{ asset('img/logoo.png') }}" width="200" height="200" class="logo" alt="Logo">
                    <h1>Selamat Datang!</h1>
                    <p>Aplikasi ini dirancang untuk memudahkan Anda dalam mengelola dan memantau praktik anak di berbagai instansi dan industri.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('login/script.js') }}"></script>
</body>

</html>

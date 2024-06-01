

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">


    <title>@yield('title')</title>
   
</head>

<body style=" background-color: #f8f9fa">
    
    
    
    <nav class="navbar navbar-expand sticky-top" style="background-color:#1c2331">
   
        @auth
            @if (auth()->user()->role == 'siswa')
                <a href="{{route('dashboardsiswa')}}" class="nav-link nav-item text-light" >Siswa</a>
               
            @elseif(auth()->user()->role == 'admin')
                <a href="{{route('homesiswa')}}" class="nav-link nav-item text-light" >Siswa</a>
                <a href="{{route('homeinstansi')}}" class="nav-link nav-item text-light" >Instansi</a>
                <a href="{{route('homepembimbing')}}" class="nav-link nav-item text-light" >Pembimbing</a>
                <a href="{{route('homemenempati')}}" class="nav-link nav-item text-light" >Penempatan</a>
                <a href="{{route('homemembimbing')}}" class="nav-link nav-item text-light" >Membimbing</a>
                <a href="{{route('dataPenempatan')}}" class="nav-link nav-item text-light" >Data Penempatan</a>
               
    
    
            @elseif(auth()->user()->role == 'guru')
               
                
                
            @endif
            <a href="{{route('logout')}}" class="nav-link nav-item text-light">Logout</a>
            <a href="" class="nav-link nav-item text-light" style="margin-left: 10%"><i class="bi bi-person-fill"></i> {{ auth()->user()->username }} </a>
            
    
        @endauth
       
        
    
    
    </nav>
    <div class="content">
        @yield('content')
    </div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>


    
    <script>
        new DataTable('#example');
    </script>
    <script>
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua item dropdown
                dropdownItems.forEach(item => {
                    item.classList.remove('active');
                });

                // Tambahkan kelas 'active' pada item yang diklik
                this.classList.add('active');
            });
        });

        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownMenu.addEventListener('hidden.bs.collapse', function() {
            dropdownMenu.classList.remove('show');
        });
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk instansi
            $('#instansi').select2({

                placeholder: "Select an option",
                allowClear: true
            });

            // Inisialisasi Select2 untuk siswa
            $('#siswa').select2({

                placeholder: "Select an option",
                allowClear: true,
            });
            // Inisialisasi Select2 untuk pembimbing

            $('#pembimbing').select2({

                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
</body>

</html>


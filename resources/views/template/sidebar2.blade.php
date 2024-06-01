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
    <style>
        .sidebar {
            width: 255px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
            z-index: 1000;
            /* Ensure sidebar is above other content */
        }

        .sidebar a,
        .logout-btn {
            padding: 15px 20px;
            display: block;
            color: black;
            text-decoration: none;
        }

        .sidebar a:hover,
        .logout-btn:hover {
            background-color: #080761;
            color: white;
        }

        .content {
            padding: 20px;
        }

        .navbar-custom {
            height: 56px;
            /* Adjust as needed */
        }

        .dropdown-item.active {
            background-color: #080761;
            /* Warna latar belakang yang diinginkan */
        }

        .logo {
            padding: 0px 20px 20px;
            /* Jarak antara logo dan judul */
        }

        @media (min-width: 768px) {
            .sidebar {
                height: 100vh;
            }

            .content {
                margin-left: 255px;
            }

            .navbar-custom {
                margin-left: 255px;
            }
        }

        @media (min-width: 576px) {
            .sidebar {
                height: 100vh;
            }

            .content {
                margin-left: 255px;
            }

            .navbar-custom {
                margin-left: 255px;
            }
        }

        @media (max-width: 767px) {

            /* CSS rules for devices with width up to 767px (e.g., smartphones) */
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 0;
            }

            .content {
                margin-left: 0;
            }

            .navbar-custom {
                margin-left: 0;
            }
        }
    </style>
</head>

<body style=" background-color: #f8f9fa">

    <div class="sidebar shadow col-md-3 col-lg-2">
        <h1 class="logo">HUBIN</h1>
        <a href="{{ route('dashboardsiswa') }}"><i class="bi bi-house"></i> Dashboard</a>


        <a href="#dropdownMenu" class="dropdown-toggle" data-bs-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="dropdownMenu"><i class="bi bi-journal"></i> PKL</a>
        <div class="collapse" id="dropdownMenu">
            <a href="{{ route('homeabsen') }}" class="dropdown-item"><i class="bi bi-person"></i> Absensi Siswa</a>
            {{-- <a href="{{ route('homeinstansi') }}" class="dropdown-item"><i class="bi bi-building"></i> Instansi</a>
            <a href="{{ route('homepembimbing') }}" class="dropdown-item"><i class="bi bi-person-check"></i>
                Pembimbing</a>
            <a href="{{ route('homemenempati') }}" class="dropdown-item"><i class="bi bi-geo-alt"></i> Penempatan</a>
            <a href="{{ route('homemembimbing') }}" class="dropdown-item"><i class="bi bi-people"></i> Membimbing</a>
            <a href="{{ route('dataPenempatan') }}" class="dropdown-item"><i class="bi bi-file-earmark-text"></i> Data
                Penempatan</a> --}}
        </div>


    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">@yield('title')</a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->username }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li> --}}
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i>
                                Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
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

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
        .dropdown-item1 {
            padding: 10px 20px;
            /* Atur padding sesuai kebutuhan */
            font-size: 16px;
            /* Atur ukuran font sesuai kebutuhan */
            color: #333;
            /* Warna teks */
            text-decoration: none;
            /* Hilangkan garis bawah pada tautan */
            display: block;
            /* Agar item dropdown tampil sebagai blok */
        }

        .imaged {
            height: auto;
            border-radius: 6px;
        }

        .imaged.w64 {
            width: 30px !important;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 255px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            z-index: 1000;
            /* Ensure sidebar is above other content */
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 60px; /* Lebar sidebar saat ditutup */
        }

        .sidebar .sidebar-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #080761;
            color: white;
        }

        .sidebar .sidebar-custom a {
            color: white;
            font-weight: bold;
        }

        .sidebar .sidebar-custom .toggle-btn {
            font-size: 24px;
            cursor: pointer;
        }

        .sidebar .sidebar-custom .toggle-btn.collapsed {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 56px;
            background-color: #080761;
            color: white;
            border-radius: 0 6px 6px 0;
        }

        .sidebar .sidebar-custom .toggle-btn i {
            margin: 0;
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
            margin-left: 255px;
            transition: margin-left 0.3s ease;
        }
        .content.collapsed {
            margin-left: 60px;
        }
        .navbar-custom {
            height: 56px;
            /* Adjust as needed */
        }

        .sidebar-custom {
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

            .sidebar.collapsed {
                width: 60px;
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

<body style="background-color: #f8f9fa">

    <div class="sidebar shadow col-md-3 col-lg-2" id="sidebar">
        <div class="sidebar-custom" style="background-color: #080761">
            <h5  class="text-white text-center">SIMAE-2024</h5>
            <div class="toggle-btn" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </div>
        </div>
        
        <div class="logo text-center">
            <img src="{{ asset($guru_mapel_pkl->foto) }}" alt="avatar" class="imaged mt-4 w-50 rounded">
            <p class="mt-1 fw-bold">{{ $guru_mapel_pkl->nama }} <br> <span style="font-weight: normal; font-size: 14px">Guru Mapel PKL</span></p>
        </div>
        <a href="{{ route('datajurnal') }}"><i class="bi bi-house"></i> Jurnal</a>
        <a href="{{ route('datasiswa') }}"><i class="bi bi-house"></i> Siswa</a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom text-white" style="background-color: #080761">
        <div class="container">
            <a class="navbar-brand text-white" href="#">@yield('title')</a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset($guru_mapel_pkl->foto) }}" alt="avatar" class="imaged w64 rounded">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item1" href="#"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item1" href="{{ route('logout') }}"><i
                                    class="bi bi-box-arrow-right"></i> Logout</a></li>
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
        var sidebarToggle = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            if (sidebar.classList.contains('collapsed')) {
                sidebarToggle.classList.add('collapsed');
            } else {
                sidebarToggle.classList.remove('collapsed');
            }
        });

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
    </script>
   
    </script>
</body>

</html>

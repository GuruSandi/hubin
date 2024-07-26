<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMAE-2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('sidebar1/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        .select2-container .select2-selection--single {
            height: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
        }
    </style>
</head>

<body>
    <nav class="sidebar" style="box-shadow: ">
        <div class="text-center" style="background-color: #080761; height: 60px; padding-top: 15px">
            <a href="#" class="logo text-white ">SIMAE-2024</a>
        </div>
        <div class="logofoto text-center">
            <img src="{{ asset($guru_mapel_pkl->foto) }}" alt="avatar" class="imaged mt-4 w-50 rounded">
            <p class="mt-1 fw-bold">{{ $guru_mapel_pkl->nama }} <br> <span
                    style="font-weight: normal; font-size: 14px">Guru Mapel PKL</span></p>
        </div>
        <div class="menu-content">
            <ul class="menu-items">
                <li class="item {{ \Route::is('dashboardguru*') ? 'active1' : '' }}">
                    <a href="{{ route('dashboardguru') }}"><i class="fas fa-home mx-2"></i> Home</a>

                </li>

                <li class="item">
                    <div class="submenu-item">
                        <span>Absensi Siswa</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Absensi Siswa
                        </div>
                        <li class="item {{ \Route::is('dataabsensi') ? 'active1' : '' }}">
                            <a href="{{ route('dataabsensi') }}"><i class="fas fa-list mx-2"></i>Data Absensi</a>

                        </li>
                        <li class="item {{ \Route::is('dataabsensi.rekapabsen') ? 'active1' : '' }}">
                            <a href="{{ route('dataabsensi.rekapabsen') }}"> <i class="fas fa-chart-bar mx-2"></i> Rekap Absen</a>

                        </li>
                    </ul>



                </li>
                
                <li class="item {{ \Route::is('datajurnal') ? 'active1' : '' }}">
                    <a href="{{ route('datajurnal') }}"><i class="fas fa-book mx-2"></i> Jurnal</a>
                </li>
                <li class="item {{ \Route::is('nilaisiswa') ? 'active1' : '' }}">
                    <a href="{{ route('nilaisiswa') }}"><i class="fas fa-book mx-2"></i> Nilai siswa</a>
                </li>
                <li class="item {{ \Route::is('datasiswa') ? 'active1' : '' }}">
                    <a href="{{ route('datasiswa') }}"><i class="fas fa-user mx-2"></i>
                        Siswa</a>
                </li>
                <li class="item {{ \Route::is('datasiswa') ? 'active1' : '' }}">
                    <a href="{{ route('datasiswa') }}"><i class="fas fa-user mx-2"></i>
                        Nilai Siswa</a>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="navbar sticky-top">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
        <div class="d-flex justify-content-end">
            <!-- Tombol Dropdown -->
            <a href="#" id="dropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset($guru_mapel_pkl->foto) }}" alt="avatar" class="imaged w64 rounded">
            </a>

            <!-- Menu Dropdown -->
            <ul class="dropdown-menu dropdown-menu-profile rounded" style="margin-top: 40px" id="dropdownMenu">
                <li>
                    <a href="" class="dropdown-item1" style="font-size: 14px;">
                        <i class="bi bi-lock-fill"></i>
                        <span>Edit Password</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item1" style="font-size: 14px;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>


    </nav>

    <main class="main">
        @yield('content')
    </main>

    <script src="{{ asset('sidebar1/script.js') }}"></script>
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
        var dropdownToggle = document.getElementById('dropdownToggle');
        var dropdownMenu = document.getElementById('dropdownMenu');

        dropdownToggle.addEventListener('click', function(event) {
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // Tangkap klik tombol validasi
        $('.validate-btn').click(function(e) {
            e.preventDefault(); // Cegah aksi default dari link

            var validateUrl = $(this).attr('href'); // Ambil URL validasi dari atribut href
            var dataId = $(this).data('id'); // Ambil ID data untuk digunakan dalam SweetAlert

            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menyetujui jurnal ini!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL validasi jika dikonfirmasi
                    window.location.href = validateUrl;
                }
            });
        });
    </script>
    <script>
        // Tangkap klik tombol validasi
        $('.tolakvalidate-btn').click(function(e) {
            e.preventDefault(); // Cegah aksi default dari link

            var validateUrl = $(this).attr('href'); // Ambil URL validasi dari atribut href
            var dataId = $(this).data('id'); // Ambil ID data untuk digunakan dalam SweetAlert

            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menolak jurnal ini!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ditolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL validasi jika dikonfirmasi
                    window.location.href = validateUrl;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#toggleFilter').click(function() {
                $('#filterForm').toggle();
            });
        });
    </script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/jquery.min.js') }}"></script>
     <script src="{{ asset('js/select2.min.js') }}"></script>
     <script>
        $(document).ready(function() {
            
            
            $('#siswas').select2({

                placeholder: "Silahkan masukan nama siswa",
                allowClear: true,
            });
           
        });
    </script>
</body>

</html>

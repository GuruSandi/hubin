<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAPII</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('csss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js">

    <style>
        /* Optional: Additional custom styling for Select2 */
        .select2-container .select2-selection--single {
            height: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .sidebar-link {
            text-decoration: none;
        }

        a {
            text-decoration: none;
        }

        .btn.btn-sm {
            background-color: #080761;
            color: #ffffff;
            /* warna teks saat tombol normal */
            text-decoration: none;
            /* menghapus underline jika ada */
            padding: 5px 10px;
            /* sesuaikan padding dengan yang lain */
            border-radius: 3px;
            /* sudut lengkung tombol */
            transition: background-color 0.3s, color 0.3s;
            /* efek transisi hover */
        }

        .btn.btn-sm:hover {
            background-color: #fdaf07;
            /* warna background saat hover */
            color: #ffffff;
            /* warna teks saat hover */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button" style="margin-top: 20px">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#" class="text-white">SIPAPII</a>
                </div>
            </div>
            <hr style="color: #ffffff ; height: 2px; margin-top: -5px" class="w-100 fw-bold">

            <ul class="sidebar-nav">

                <li class="sidebar-item">
                    <a href="{{ route('DashboardAdmin') }}" class="sidebar-link"><i class="bi bi-house-door"></i>
                        Dashboard</a>

                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#siswaid" aria-expanded="false" aria-controls="siswaid">
                        <i class="bi bi-person"></i>
                        <span>Siswa</span>
                    </a>
                    <ul id="siswaid" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('homesiswa') }}" class="sidebar-link"><i class="bi bi-person"></i>
                                Data Siswa</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('dataabsensisiswaperhari') }}" class="sidebar-link">
                                <i class="bi bi-calendar-check"></i>
                                <span>Data Absensi Siswa Hari Ini</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('dataabsensisiswa') }}" class="sidebar-link">
                                <i class="bi bi-calendar-check"></i>
                                <span>Data Absensi Siswa</span>
                            </a>
                        </li>
                       
                        <li class="sidebar-item">
                            <a href="{{ route('datanilaisiswa') }}" class="sidebar-link">
                                <i class="bi bi-bar-chart"></i>
                                <span>Data Nilai Siswa</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#jurnalid" aria-expanded="false" aria-controls="jurnalid">
                        <i class="bi bi-book"></i>
                        <span>Jurnal Siswa</span>
                    </a>
                    <ul id="jurnalid" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                       
                        <li class="sidebar-item">
                            <a href="{{ route('datajurnalsiswa') }}" class="sidebar-link">
                                <i class="bi bi-book"></i>
                                <span>Data Jurnal Siswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('datajurnalbelumdivalidasi') }}" class="sidebar-link">
                                <i class="bi bi-book"></i>
                                <span>Jurnal Belum di validasi</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('homeinstansi') }}" class="sidebar-link"><i class="bi bi-building"></i>
                        Instansi</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#guru" aria-expanded="false" aria-controls="guru">
                        <i class="bi bi-person"></i>
                        <span>Guru</span>
                    </a>
                    <ul id="guru" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('homepembimbing') }}" class="sidebar-link"><i
                                    class="bi bi-person-check"></i>
                                Pembimbing</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('homegurumapel') }}" class="sidebar-link"><i
                                    class="bi bi-person-check"></i>
                                Guru Mapel PKL</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('homemenempati') }}" class="sidebar-link"><i class="bi bi-geo-alt"></i>
                        Penempatan</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('homemembimbing') }}" class="sidebar-link"><i class="bi bi-people"></i>
                        Membimbing</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('dataPenempatan') }}" class="sidebar-link"><i
                            class="bi bi-file-earmark-text"></i> Data
                        Penempatan</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#akun" aria-expanded="false" aria-controls="akun">
                        <i class="bi bi-journal"></i>
                        <span>Data Akun</span>
                    </a>
                    <ul id="akun" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('homeakunsiswa') }}" class="sidebar-link"><i
                                    class="bi bi-file-earmark-text"></i> Akun Siswa</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('homeGuruMapelPkl') }}" class="sidebar-link"><i
                                    class="bi bi-file-earmark-text"></i> Akun Guru Mapel PKL</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('homeakunadmin') }}" class="sidebar-link"><i
                                    class="bi bi-file-earmark-text"></i> Akun Admin</a>
                        </li>

                    </ul>
                </li>
                


                {{-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li> --}}

                <li class="sidebar-item">
                    <a href="{{ route('setting') }}" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            {{-- <div class="sidebar-footer">
               
            </div> --}}
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">

                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <h6 style="color: #080761">Welcome {{ Auth::user()->username }}! |
                                <a href="{{ route('logout') }}" class="btn btn-sm">
                                    <i class="bi  bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </a>
                            </h6>


                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">@yield('title')</h3>
                        @yield('content')
                    </div>
                </div>

            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start ">
                            <a class="text-body-secondary" href=" #">
                                <strong>SIPAPII</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('jss/script.js') }}"></script>

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
        new DataTable('#examplee');
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
            $('#siswas').select2({

                placeholder: "Silahkan masukan nama siswa",
                allowClear: true,
            });
            $('#gurumapel').select2({

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
    <script>
        // Tangkap klik tombol hapus
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href'); // Ambil URL hapus dari atribut href
            var dataId = $(this).data('id'); // Ambil ID data untuk digunakan dalam SweetAlert

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect atau hapus data sesuai kebutuhan
                    window.location.href = deleteUrl;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#toggleImport').click(function() {
                $('#importtoggle').toggle();
            });
        });
    </script>
</body>

</html>

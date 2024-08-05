<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>SIPAPII</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/jpg" href="{{ asset('img/logohubin.jpeg') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logohubin.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset('__manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <style>
        a {
            text-decoration: none;
        }

        .active {
            color: skyblue;
            /* Atur warna sesuai keinginan Anda */
        }
        
        .filter-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            justify-items: center;
            align-items: center;
            margin-top: 20px;
        }

        .filter-item {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #ffffff;
            color: #080761;
            border-radius: 10px;
            box-shadow: none;
            border: 1px solid rgb(197, 197, 197);
            cursor: pointer;
            transition: all 0.3s ease;
            /* Sesuaikan dengan tinggi yang diinginkan */
        }

        .filter-item:hover {
            background-color: #f0f0f0;
        }

        .filter-item i {
            margin-right: 10px;
        }

        @media (max-width: 575.98px) {
            .row-cols-2 {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                /* Untuk dukungan smooth scroll di iOS */
            }

            .col {
                flex: 0 0 auto;
            }


        }
    </style>

</head>

<body style="background-color: white;">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->
    {{-- id="appCapsule" --}}

    <div class="">
        @yield('content')

    </div>

    <!-- App Capsule -->

    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="{{ route('dashboardsiswa') }}" class="item {{ \Route::is('dashboardsiswa') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="home-outline" role="img" class="md hydrated text-muted fw-bold"
                    aria-label="file tray full outline">
                </ion-icon>
                <strong>Home</strong>
            </div>
        </a>


        <a href="{{ route('jurnal') }}" class="item {{ \Route::is('jurnal') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated text-muted fw-bold"
                    aria-label="document text outline"></ion-icon>
                <strong>Jurnal</strong>
            </div>
        </a>

        <a href="{{ route('profilesiswa') }}" class="item  {{ \Route::is('profilesiswa') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated text-muted fw-bold"
                    aria-label="people outline">
                </ion-icon>
                <strong>Profile</strong>
            </div>
        </a>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jurnalLink').click(function(e) {
                e.preventDefault(); // Mencegah tautan untuk berpindah ke halaman baru

                // Hapus class 'active' dari semua item lain jika diperlukan
                $('.item').removeClass('active');

                // Tambahkan class 'active' pada item yang diklik
                $(this).find('.item').addClass('active');

                // Lalu, navigasi ke halaman yang dituju
                window.location.href = $(this).attr('href');
            });
        });
    </script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.legend = new am4charts.Legend();

            chart.data = [{
                    country: "Hadir",
                    litres: 501.9
                },
                {
                    country: "Sakit",
                    litres: 301.9
                },
                {
                    country: "Izin",
                    litres: 201.1
                },
                {
                    country: "Terlambat",
                    litres: 165.8
                },
            ];



            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "litres";
            series.dataFields.category = "country";
            series.alignLabels = false;
            series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
            series.labels.template.radius = am4core.percent(-40);
            series.labels.template.fill = am4core.color("white");
            series.colors.list = [
                am4core.color("#1171ba"),
                am4core.color("#fca903"),
                am4core.color("#37db63"),
                am4core.color("#ba113b"),
            ];
        }); // end am4core.ready()
    </script>

</body>

</html>

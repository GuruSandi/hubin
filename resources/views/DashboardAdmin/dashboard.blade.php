@extends('template.sidebar')
@section('title', 'Dashboard')

@section('content')
    <div class="row mt-3">
        <div class="col-3">
            <a href="{{ route('pklluarkota') }}" style="color: inherit">
                <div style="background-color: #eae9fb; border-radius: 10px; " class="p-3">
                    <div class="row">
                        <div class="col-6">
                            <div style="background-color: #837bef; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                class="text-center text-white"><i class="bi bi-geo-fill"></i></div>
                            <h4 style="font-size: 11px" class="fw-bold mt-2">PKL Luar Kota</h4>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <h4>{{ $luarkota }}</h4>

                            </div>
                            <div class="d-flex justify-content-end">
                                <h4 style="font-size: 11px; color: #837bef" class="fw-bold mt-2">{{ $luarkota }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </a>


        </div>
        <div class="col-3">
            <a href="{{ route('pkldalamkota') }}" style="color: inherit">
                <div style="background-color: #d3f0f8; border-radius: 10px; " class="p-3">
                    <div class="row">
                        <div class="col-6">
                            <div style="background-color: #3cb2da; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                class="text-center text-white"><i class="bi bi-geo-alt-fill"></i></div>
                            <h4 style="font-size: 11px" class="fw-bold mt-2">PKL Dalam Kota</h4>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <h4>{{ $dalamkota }}</h4>

                            </div>
                            <div class="d-flex justify-content-end">
                                <h4 style="font-size: 11px; color: #3cb2da" class="fw-bold mt-2">{{ $dalamkota }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </a>


        </div>
        <div class="col-3">
            <a href="{{ route('belumditempatkan') }}" style="color: inherit">
                <div style="background-color: #f4e1fd; border-radius: 10px; " class="p-3">
                    <div class="row">
                        <div class="col-8">
                            <div style="background-color: #eabcf3; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                class="text-center text-white"><i class="bi bi-hourglass-split"></i></div>
                            <h4 style="font-size: 11px" class="fw-bold mt-2">Belum di Tempatkan</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <h4>{{ $belumditempatkan }}</h4>

                            </div>
                            <div class="d-flex justify-content-end">
                                <h4 style="font-size: 11px; color: #eabcf3" class="fw-bold mt-2">{{ $belumditempatkan }}
                                </h4>

                            </div>
                        </div>
                    </div>
                </div>
            </a>



        </div>
        <div class="col-3">
            <a href="{{ route('homesiswa') }}" style="color: inherit">
                <div style="background-color: #e4f9f2; border-radius: 10px; " class="p-3">
                    <div class="row">
                        <div class="col-6">
                            <div style="background-color: #87d9bd; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                class="text-center text-white"><i class="bi  bi-people"></i></div>
                            <h4 style="font-size: 11px" class="fw-bold mt-2">Total Siswa</h4>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <h4>{{ $siswa }}</h4>

                            </div>
                            <div class="d-flex justify-content-end">
                                <h4 style="font-size: 11px; color: #87d9bd" class="fw-bold mt-2">{{ $siswa }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </a>



        </div>

    </div>
    
    <div class="row mt-3">

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3 fw-bold" style="color: #080761">Penempatan Terbaru</h6>
                    <table class="table  " style="font-size: 13px">
                        <thead style="background-color: #eae9fb;">
                            <tr>
                                <th scope="col" style="color: #837bef">#</th>
                                <th scope="col" style="color: #837bef">Nama Siswa</th>
                                <th scope="col" style="color: #837bef">Instansi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataterbaru as $placement)
                                <tr>
                                    <th scope="row" class="text-muted">{{ $loop->iteration }}</th>
                                    <td style="color: #080761">{{ $placement->siswa->nama }}</td>
                                    <td style="color: #080761">{{ $placement->instansi->instansi }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3 fw-bold text-center" style="color: #080761">Data Siswa PKL</h6>

                    <canvas id="domisiliChart" ></canvas>

                </div>
            </div>
        </div>
       
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('domisiliChart').getContext('2d');
        var domisiliChart = new Chart(ctx, {
            type: 'pie', // Mengubah tipe chart menjadi pie chart
            data: {
                labels: ['Sukabumi', 'Luar Kota'],
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: [{{ $dalamkota }}, {{ $luarkota }}],
                    backgroundColor: ['#837bef', '#eae9fb']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top', // Letak legenda chart
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(0);
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection

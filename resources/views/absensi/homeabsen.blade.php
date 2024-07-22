@extends('template.nav')
@section('title', 'Absensi')

@section('content')
    {{-- @if (Session::has('status'))
<div class="alert alert-success d-flex align-items-center" role="alert">
    <strong class="mr-auto">Success: {{ Session::get('status') }}</strong>
    <!-- mr-auto untuk memberikan margin kanan otomatis agar teks sejajar dengan tombol close -->
    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
        <!-- ml-2 untuk memberikan margin kiri -->
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif --}}
    <div id="bgabsen">
        <div class="container">

            <div class="row">
                <div class="col-4">
                    <div style="width: 40px">
                        <a href="{{ route('dashboardsiswa') }}">
                            <div style="background-color: #faac05; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                class="text-center text-white"> <i class="bi bi-arrow-left bi-lg"></i>
                            </div>
                        </a>
                    </div>

                    <h4 class="text-white mt-3">Absensi</h4>
                </div>
                <div class="col-8">
                    <div class="d-flex justify-content-end">
                        <div id="toggleFilter" class="filter-item p-2 mt-5" style="font-size: 12px">
                            <i class="bi bi-funnel"></i> Filter Tanggal
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="container" style="margin-bottom: 90px">

        <div class="row mt-3">
            <div id="filterForm" style="display: none;">
                <form action="{{ route('searchabsen') }}" method="GET">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary"> Cari</button>

                    </div>
                </form>
            </div>
        </div>
        <div class="row g-3">
            @foreach ($absensisiswa as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card mt-3" style="border-radius: 10px">
                        <div class="card-body ">

                            <div class="row">

                                <div class="row">
                                    <div class="col-12">
                                        {{-- <p class="fw-bold">{{ substr($item->deskripsi_jurnal, 0, strpos($item->deskripsi_jurnal, ' ', strpos($item->deskripsi_jurnal, ' ') + 1)) }}</p> --}}
                                        <h5 class="fw-bold">{{ $item->tanggal }}</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="bi bi-geo-alt-fill" style="color: red; font-size: 40px;"></i>

                                            </div>
                                            <div class="col-8">
                                                <h4 class="text-muted"> Jam Masuk</h4>
                                                <p class="text-primary fw-bold">{{ $item->jam_masuk }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="bi bi-geo-alt-fill" style="color: red; font-size: 40px;"></i>

                                            </div>
                                            <div class="col-8">
                                                <h4 class="text-muted"> Jam Pulang</h4>
                                                <p class="text-primary fw-bold">{{ $item->jam_pulang }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="width: 90%">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-muted">Keterangan : @if ($item->keterangan == 'hadir')
                                                Hadir
                                            @elseif ($item->keterangan == 'libur')
                                                Libur
                                            @elseif ($item->keterangan == 'tidak_masuk_pkl')
                                                Tidak Masuk PKL
                                            @endif
                                        </p>
                                       

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach


        </div>
       

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#toggleFilter').click(function() {
                $('#filterForm').toggle();
            });
        });
    </script>




@endsection

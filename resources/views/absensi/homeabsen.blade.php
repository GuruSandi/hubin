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
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <button type="submit" name="action" class="btn btn-primary" style="margin-top: 30px" value="search"><i
                                    class="bi bi-search"></i> Cari</button>

                            <button type="submit" name="action" class="btn btn-success" style="margin-top: 30px" value="download_excel"><i
                                    class="bi bi-file-excel"></i> Export Excel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id=""
                    style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensisiswa as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($absensisiswa->currentPage() - 1) * $absensisiswa->perPage() }}
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam_masuk }}</td>
                                <td>{{ $item->jam_pulang }}</td>
                                
                                <td>
                                    @if ($item->keterangan == 'hadir')
                                        Hadir
                                    @elseif ($item->keterangan == 'libur')
                                        Libur
                                    @elseif ($item->keterangan == 'tidak_hadir_pkl')
                                        Tidak Masuk PKL
                                    @elseif ($item->keterangan == 'absen')
                                        Alpa
                                    @endif
                                </td>
    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mb-2">
                    <div class="col-md-6">
                        @php
                            $from = ($absensisiswa->currentPage() - 1) * $absensisiswa->perPage() + 1; // Hitung dari
                            $to = min($from + $absensisiswa->count() - 1, $absensisiswa->total()); // Hitung sampai
                        @endphp
                        <p>Showing {{ $from }} to {{ $to }} of {{ $absensisiswa->total() }}
                            entries</p>
                    </div>
                    <div class="col-md-6">
                        {{ $absensisiswa->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
            {{-- @foreach ($absensisiswa as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card mt-3" style="border-radius: 10px">
                        <div class="card-body ">

                            <div class="row">

                                <div class="row">
                                    <div class="col-12">
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
                                            @elseif ($item->keterangan == 'tidak_hadir_pkl')
                                                Tidak Masuk PKL
                                            @elseif ($item->keterangan == 'absen')
                                                Alpa
                                            @endif
                                        </p>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach --}}


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

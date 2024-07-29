@extends('template.navbar')
@section('title', 'Jurnal')

@section('content')
    <div class="sticky-top" id="bgjurnal">
        <div class="container">
            <h4 class="text-white mt-2">Jurnal</h4>

        </div>
    </div>
    <div class="container" style="margin-bottom: 90px">
        <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-3" style="font-size: 12px">
            <div class="col">
                <div id="toggleFilter" class="filter-item p-2 mt-3">
                    <i class="bi bi-funnel"></i> Filter Tanggal
                </div>
            </div>
            <a href="{{ route('jurnalbelumdivalidasi') }}">
                <div class="col">
                    <div id="toggleFilter2" class="filter-item p-2 mt-3 text-warning">
                        <i class="bi bi-exclamation-triangle"></i> Belum divalidasi
                    </div>
                </div>
            </a>

            <a href="{{ route('jurnalditolak') }}">
                <div class="col">
                    <div id="toggleFilter3" class="filter-item p-2 mt-3 text-danger">
                        <i class="bi bi-x-circle"></i> Ditolak
                    </div>
                </div>
            </a>
            <a href="{{ route('jurnaltervalidasi') }}">
                <div class="col">
                    <div id="toggleFilter4" class="filter-item p-2 mt-3 text-success">
                        <i class="bi bi-check-circle"></i> Sudah divalidasi
                    </div>
                </div>
            </a>

        </div>

        <div class="row mt-3">
            <div id="filterForm" style="display: none;">
                <form action="{{ route('jurnal.search') }}" method="GET">
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
        
        <div class="row g-3">
            @foreach ($jurnal as $item)
                <div class="col-md-6 col-lg-6">
                    <div class="card mt-3" style="border-radius: 10px">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-6">
                                    <p style="font-size: 16">{{ $item->tanggal }}</p>
                                </div>
                                <div class="col-6">
                                    @if ($item->validasi == 'belum_tervalidasi')
                                        <div class="d-flex justify-content-end">
                                            <p class="text-white bg-warning px-1"
                                                style="font-size: 11px ; border-radius: 10px">
                                                Belum divalidasi</p>

                                        </div>
                                    @elseif ($item->validasi == 'ditolak')
                                        <div class="d-flex justify-content-end">
                                            <p class="text-white bg-danger px-1"
                                                style="font-size: 11px ; border-radius: 10px">
                                                Ditolak</p>
                                        </div>
                                    @elseif ($item->validasi == 'tervalidasi')
                                        <div class="d-flex justify-content-end">
                                            <p class="text-white bg-success px-1"
                                                style="font-size: 11px ; border-radius: 10px">
                                                Sudah divalidasi</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted">Deskripsi Jurnal :</p>
                                    <p>{{ $item->deskripsi_jurnal }}</p>
                                    <div class="d-flex justify-content-end">
                                        @if ($item->validasi == 'belum_tervalidasi')
                                            <a href="{{ route('jurnal.edit', $item->id) }}" class="btn btn-primary">Ubah
                                                Jurnal</a>
                                        @elseif ($item->validasi == 'ditolak')
                                            <a href="{{ route('jurnal.edit', $item->id) }}" class="btn btn-primary">Ubah
                                                Jurnal</a>
                                        @endif
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

@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Data Absensi Siswa</p>
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div id="toggleFilter" class="btn btn-warning text-white" style="font-size: 12px">
                                    <i class="bi bi-funnel"></i> Filter Tanggal
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-8 mt-3">
                            <div id="filterForm" style="display: none; font-size: 12px">
                                <form action="{{ route('dataabsensi.searchabsensisiswa') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-5">
                                            <label for="start_date">Tanggal Mulai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3"
                                                id="start_date" name="start_date">

                                        </div>
                                        <div class="col-md-6 col-lg-5">
                                            <label for="end_date">Tanggal Selesai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3 "
                                                id="end_date" name="end_date">

                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <button type="submit" class="btn mb-3 mt-3 btn-sm btn-primary">Filter</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered" id=""
                                style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Jarak Absen</th>
                                        <th>Instansi</th>
                                        <th>Keterangan</th>
                                        <th>Pembimbing</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($siswa->currentPage() - 1) * $siswa->perPage() }}
                                            </td>
                                            <td onclick="openModal({{ $item->id }})">{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->kelas_siswa }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->jam_masuk }}</td>
                                            <td>{{ $item->jam_pulang }}</td>
                                            <td>
                                                {{ number_format($item->jarak, 0, ',', '.') }} Meter
                                            </td>
                                            <td>{{ $item->instansi }}</td>
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
                                            <td>{{ $item->nama_pembimbing }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm mx-1 btn-success"
                                                    onclick="openModal({{ $item->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    @php
                                        $from = ($siswa->currentPage() - 1) * $siswa->perPage() + 1; // Hitung dari
                                        $to = min($from + $siswa->count() - 1, $siswa->total()); // Hitung sampai
                                    @endphp
                                    <p>Showing {{ $from }} to {{ $to }} of {{ $siswa->total() }}
                                        entries</p>
                                </div>
                                <div class="col-md-6">
                                    {{ $siswa->links() }} <!-- Pagination links -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @foreach ($siswa as $item)
            <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
            <div class="custom-modal" id="modal{{ $item->id }}" style="display: none;">
                <div class="custom-modal-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title">Detail</h5>

                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="custom-close-btn"
                                    onclick="closeModal({{ $item->id }})">&times;</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nama Siswa</dt>
                        <dd class="col-sm-8">{{ $item->nama_siswa }}</dd>
                        <dt class="col-sm-4">Kelas</dt>
                        <dd class="col-sm-8">{{ $item->kelas_siswa }}</dd>
                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8">{{ $item->tanggal }}</dd>
                        <dt class="col-sm-4">Jam Masuk</dt>
                        <dd class="col-sm-8">{{ $item->jam_masuk }}</dd>
                        <dt class="col-sm-4">Jam Pulang</dt>
                        <dd class="col-sm-8">{{ $item->jam_pulang }}</dd>
                        <dt class="col-sm-4">Jarak Absen</dt>
                        <dd class="col-sm-8">{{ number_format($item->jarak, 0, ',', '.') }} Meter</dd>
                        <dt class="col-sm-4">Instansi</dt>
                        <dd class="col-sm-8">{{ $item->instansi }}</dd>
                        <dt class="col-sm-4">Keterangan</dt>
                        <dd class="col-sm-8">
                            @if ($item->keterangan == 'hadir')
                                Hadir
                            @elseif ($item->keterangan == 'libur')
                                Libur
                            @elseif ($item->keterangan == 'tidak_masuk_pkl')
                                Tidak Masuk PKL
                            @elseif ($item->keterangan == 'absen')
                                Alpa
                            @endif
                        </dd>
                        <dt class="col-sm-4">Pembimbing</dt>
                        <dd class="col-sm-8">{{ $item->nama_pembimbing }}</dd>
                    </dl>
                </div>
                <div class="custom-modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            onclick="closeModal({{ $item->id }})">Close</button>
                    </div>

                </div>
            </div>
        @endforeach

        <script>
            function openModal(id) {
                document.getElementById('modal' + id).style.display = 'block';
                document.getElementById('modalBackdrop' + id).style.display = 'block';
            }

            function closeModal(id) {
                document.getElementById('modal' + id).style.display = 'none';
                document.getElementById('modalBackdrop' + id).style.display = 'none';
            }

            // Close modal when clicking outside of it
            document.addEventListener('click', function(event) {
                if (event.target.matches('.custom-modal-backdrop')) {
                    const modals = document.querySelectorAll('.custom-modal');
                    modals.forEach((modal) => {
                        if (event.target.id === 'modalBackdrop' + modal.id.replace('modal', '')) {
                            closeModal(modal.id.replace('modal', ''));
                        }
                    });
                }
            });
        </script>
    </div>

@endsection

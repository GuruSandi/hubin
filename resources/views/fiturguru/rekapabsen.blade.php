@extends('template.sidebar1')
@section('title', 'Rekap Absensi')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Rekap Absensi Siswa</p>
                        {{-- <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div id="toggleFilter" class="btn btn-warning text-white" style="font-size: 12px">
                                    <i class="bi bi-funnel"></i> Filter Tanggal
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-8 mt-3">
                            <div id="filterForm" style="display: none; font-size: 12px">
                                <form action="{{ route('dataabsensi.seachrekapabsen') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-5">
                                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3"
                                                id="tanggal_mulai" name="tanggal_mulai">

                                        </div>
                                        <div class="col-md-6 col-lg-5">
                                            <label for="tanggal_akhir">Tanggal Selesai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3 "
                                                id="tanggal_akhir" name="tanggal_akhir">

                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <button type="submit" class="btn mb-3 mt-3 btn-sm btn-primary">Filter</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div> --}}
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-striped table-bordered" id="example" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Hadir</th>
                                        <th>Libur</th>
                                        <th>Alpa</th>
                                        <th>Tidak Masuk PKL</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekapabsen as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>
                                                @if ($tanggalMulai && $tanggalAkhir)
                                                    <!-- Jika filter tanggal aktif, arahkan ke halaman pencarian absensi -->
                                                    <a href="{{ route('dataabsensi.seachdetailrekapabsen', ['siswa_id' => $item->siswa_id]) }}?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                                                        class="text-dark" style="text-decoration: none">
                                                        {{ $item->nama_siswa }}
                                                    </a>
                                                @else
                                                    <!-- Jika filter tanggal tidak aktif, arahkan ke detail absensi -->
                                                    <a href="{{ route('dataabsensi.detailrekapabsensi', ['siswa_id' => $item->siswa_id]) }}"
                                                        class="text-dark" style="text-decoration: none;">
                                                        {{ $item->nama_siswa }}
                                                    </a>
                                                @endif
                                            </td> --}}
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->kelas_siswa }}</td>
                                            <td>{{ $item->total_hadir }}</td>
                                            <td>{{ $item->total_libur }}</td>
                                            <td>{{ $item->total_absen }}</td>
                                            <td>{{ $item->total_tidak_hadir_pkl }}</td>
                                            <td>
                                                {{-- <a href="{{ route('dataabsensi.detailrekapabsensi', ['siswa_id' => $item->siswa_id, 'tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir]) }}"
                                                    class="btn btn-sm mx-1 btn-success">
                                                     <i class="fas fa-eye"></i>
                                                 </a> --}}
                                                {{-- @if ($tanggalMulai && $tanggalAkhir)
                                                    <!-- Jika filter tanggal aktif, arahkan ke halaman pencarian absensi -->
                                                    <a href="{{ route('dataabsensi.seachdetailrekapabsen', ['siswa_id' => $item->siswa_id]) }}?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                                                        class="btn btn-sm mx-1 btn-success">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <!-- Jika filter tanggal tidak aktif, arahkan ke detail absensi -->
                                                    <a href="{{ route('dataabsensi.detailrekapabsensi', ['siswa_id' => $item->siswa_id]) }}"
                                                        class="btn btn-sm mx-1 btn-success">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif --}}
                                                <button type="button" class="btn btn-sm mx-1 btn-success"
                                                    onclick="openModal({{ $item->siswa_id }})">
                                                    <i class="fas fa-eye"></i>

                                                </button>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    @foreach ($rekapabsen as $item)
        <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->siswa_id }}" style="display: none;"></div>
        <div class="custom-modal" id="modal{{ $item->siswa_id }}" style="display: none; overflow-y: auto;">
            <div class="modal-content">
                <div class="custom-modal-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title">Detail</h5>

                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="custom-close-btn"
                                    onclick="closeModal({{ $item->siswa_id }})">&times;</button>
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
                        <dt class="col-sm-4">Hadir</dt>
                        <dd class="col-sm-8">{{ $item->total_hadir }}</dd>
                        <dt class="col-sm-4">Libur</dt>
                        <dd class="col-sm-8">{{ $item->total_libur }}</dd>
                        <dt class="col-sm-4">Alpa</dt>
                        <dd class="col-sm-8">{{ $item->total_absen }}</dd>
                        <dt class="col-sm-4">Tidak Masuk PKL</dt>
                        <dd class="col-sm-8">{{ $item->total_tidak_hadir_pkl }}</dd>

                    </dl>
                </div>
                <div class="custom-modal-footer">

                    <div class="d-flex justify-content-end">

                        <button type="button" class="btn btn-secondary mx-1"
                            onclick="closeModal({{ $item->siswa_id }})">Keluar</button>
                    </div>
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

@endsection

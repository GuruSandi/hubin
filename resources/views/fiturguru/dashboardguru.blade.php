@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

    <div class="container mt-4 bg-white">
        <div class="row g-3">

            <div class="col-md-4 col-lg-3">
                <a href="{{ route('dashboardguru.sudahabsen') }}" style="color: inherit; text-decoration: none">
                    <div style="background-color: #eae9fb; border-radius: 10px; " class="p-3">
                        <div class="row">
                            <div class="col-6">
                                <div style="background-color: #837bef; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                    class="text-center text-white p-1"><i class="fas fa-check"></i></div>
                                <h4 style="font-size: 11px" class="fw-bold mt-2">Sudah Absen</h4>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <h4>{{ $sudahabsen }}</h4>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <h4 style="font-size: 11px; color: #837bef" class="fw-bold mt-2">hari ini</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>


            </div>
            <div class="col-md-3 col-lg-3">
                <a href="{{ route('dashboardguru.belumabsen') }}" style="color: inherit; text-decoration: none">
                    <div style="background-color: #f8d3d3; border-radius: 10px; " class="p-3">
                        <div class="row">
                            <div class="col-6">
                                <div style="background-color: #da3c3c; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                    class="text-center text-white p-1"><i class="fas fa-times"></i></div>
                                <h4 style="font-size: 11px" class="fw-bold mt-2">Belum Absen</h4>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <h4>{{ $belumabsen }}</h4>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <h4 style="font-size: 11px; color: #da3c3c" class="fw-bold mt-2">hari ini</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>


            </div>
            <div class="col-md-3 col-lg-3">
                <a href="{{ route('dashboardguru.jurnalhariini') }}" style="color: inherit; text-decoration: none">
                    <div style="background-color: #f4e1fd; border-radius: 10px; " class="p-3">
                        <div class="row">
                            <div class="col-8">
                                <div style="background-color: #eabcf3; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                    class="text-center text-white p-1"><i class="fas fa-book"></i></div>
                                <h4 style="font-size: 11px" class="fw-bold mt-2">Jurnal Siswa</h4>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <h4>{{ $jurnalsiswa }}</h4>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <h4 style="font-size: 11px; color: #eabcf3" class="fw-bold mt-2"> hari ini
                                    </h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>



            </div>
            <div class="col-md-3 col-lg-3">
                <a href="{{ route('datasiswa') }}" style="color: inherit;  text-decoration: none">
                    <div style="background-color: #e4f9f2; border-radius: 10px; " class="p-3">
                        <div class="row">
                            <div class="col-6">
                                <div style="background-color: #87d9bd; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                                    class="text-center text-white"><i class="bi  bi-people"></i></div>
                                <h4 style="font-size: 11px" class="fw-bold mt-2">Total Siswa</h4>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <h4>{{ $jumlahsiswa }}</h4>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <h4 style="font-size: 11px; color: #87d9bd" class="fw-bold mt-2">{{ $jumlahsiswa }}
                                    </h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>



            </div>

        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold">Absensi Terbaru</p>
                        <div class="table-wrapper">
                            <table class="table table-striped table-sm table-bordered" style="font-size: 12px">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensiterbaru as $item)
                                        <tr onclick="openModal({{ $item->id }})">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->kelas_siswa }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->jam_masuk }}</td>
                                            <td>{{ $item->jam_pulang }}</td>
                                            <td>{{ number_format($item->jarak, 0, ',', '.') }} Meter</td>
                                            <td>{{ $item->instansi }}</td>
                                            <td>
                                                @if ($item->keterangan == 'hadir')
                                                    Hadir
                                                @elseif ($item->keterangan == 'libur')
                                                    Libur
                                                @elseif ($item->keterangan == 'tidak_masuk_pkl')
                                                    Tidak Masuk PKL
                                                @elseif ($item->keterangan == 'absen')
                                                    Alpa
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_pembimbing }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Template -->
        @foreach ($absensiterbaru as $item)
            <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
            <div class="custom-modal" id="modal{{ $item->id }}" style="display: none;">
                <div class="custom-modal-header">
                   <div class="row">
                    <div class="col-6">
                        <h5 class="custom-modal-title">Detail Absensi</h5>
                        
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



        {{-- <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold">Jurnal Terbaru</p>
                        <table class="table table-sm table-bordered" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Jurnal</th>
                                    <th>Instansi</th>
                                    <th>Pembimbing</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurnalterbaru as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas_siswa }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td style="width: 400px">{{ $item->deskripsi_jurnal }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->nama_pembimbing }}</td>
                                        <td style="width: 100px" class="text-center">

                                            @if ($item->validasi == 'tervalidasi')
                                                <button type="button" class="btn btn-sm mx-1 btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-check"></i>

                                                </button>
                                            @elseif($item->validasi == 'ditolak')
                                                <button type="button" class="btn btn-sm mx-1 btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-times"></i>

                                                </button>
                                            @else
                                                <a href="{{ route('validasisetuju', $item->id) }}"
                                                    class="btn btn-sm btn-success mx-1 validate-btn"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <a href="{{ route('validasiditolak', $item->id) }}"
                                                    class="btn btn-sm btn-danger tolakvalidate-btn"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                    @include('fiturguru.validasi')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>jurnal</th>
                    <th>Jarak Absen</th>
                    <th>Instansi</th>
                    <th>Pembimbing</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas_siswa }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_masuk }}</td>
                        <td>{{ $item->jam_pulang }}</td>
                        <td>{{ $item->deskripsi_jurnal }}</td>
                        <td>{{ number_format($item->jarak, 0, ',', '.') }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->nama_pembimbing }}</td>
                        <td>

                            @if ($item->validasi == 'tervalidasi')
                                <button type="button" class="btn mx-1 btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    disetujui
                                </button>
                            @elseif($item->validasi == 'ditolak')
                                <button type="button" class="btn mx-1 btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    ditolak
                                </button>
                            @else
                                <a href="{{ route('validasisetuju', $item->id) }}"
                                    onclick="return confirm('apakah anda yakin?')" class="btn btn-primary">setujui</a>
                                <a href="{{ route('validasiditolak', $item->id) }}"
                                    onclick="return confirm('apakah anda yakin?')" class="btn btn-danger">tolak</a>
                            @endif

                        </td>
                    </tr>
                    @include('fiturguru.validasi')
                @endforeach
            </tbody>
        </table> --}}
    </div>

@endsection

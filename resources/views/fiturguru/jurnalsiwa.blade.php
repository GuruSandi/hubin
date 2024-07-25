@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold mb-4">Jurnal Siswa</p>
                    <div class="row">
                        <div class="col-3">
                            <div id="toggleFilter" class="btn btn-warning text-white" style="font-size: 12px">
                                <i class="bi bi-funnel"></i> Filter Tanggal
                            </div>
                        </div>
                    </div>
                    <div class="row col-8 mt-3">
                        <div id="filterForm" style="display: none; font-size: 12px">
                            <form action="{{ route('datajurnal.search') }}" method="GET">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="start_date">Tanggal Mulai:</label>
                                        <input type="date" required class="form-control form-control-sm mb-3" id="start_date"
                                            name="start_date">

                                    </div>
                                    <div class="col-5">
                                        <label for="end_date">Tanggal Selesai:</label>
                                        <input type="date" required class="form-control form-control-sm mb-3 " id="end_date"
                                            name="end_date">

                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn mb-3 mt-3 btn-sm btn-primary">Filter</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="example" style="font-size: 12px">
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
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td onclick="openModal({{ $item->id }})">{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas_siswa }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td style="width: 400px">{{ $item->deskripsi_jurnal }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->nama_pembimbing }}</td>
                                        <td style="width: 130px" class="text-center">
                                            <button type="button" class="btn btn-sm mx-1 btn-success"
                                                onclick="openModal({{ $item->id }})">
                                                <i class="fas fa-eye"></i>

                                            </button>
                                            @if ($item->validasi == 'tervalidasi')
                                                <button onclick="openModal1({{ $item->id }})" type="button"
                                                    class="btn btn-sm mx-1 btn-primary">
                                                    <i class="fas fa-check"></i>

                                                </button>
                                            @elseif($item->validasi == 'ditolak')
                                                <button type="button" onclick="openModal1({{ $item->id }})"
                                                    class="btn btn-sm mx-1 btn-danger">
                                                    <i class="fas fa-times"></i>

                                                </button>
                                            @else
                                                <a href="{{ route('validasisetuju', $item->id) }}"
                                                    class="btn btn-sm btn-primary mx-1 validate-btn"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @foreach ($siswa as $item)
        <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
        <div class="custom-modal" id="modal{{ $item->id }}" style="display: none; overflow-y: auto;">
            <div class="modal-content">
                <div class="custom-modal-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title">Detail Jurnal</h5>

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
                        <dt class="col-sm-4">Deskripsi Jurnal</dt>
                        <dd class="col-sm-8">{{ $item->deskripsi_jurnal }}</dd>
                        <dt class="col-sm-4">Instansi</dt>
                        <dd class="col-sm-8">{{ $item->instansi }}</dd>
                        <dt class="col-sm-4">Pembimbing</dt>
                        <dd class="col-sm-8">{{ $item->nama_pembimbing }}</dd>
                        <dt class="col-sm-4">Status Jurnal</dt>
                        <dd class="col-sm-8">
                            @if ($item->validasi == 'tervalidasi')
                                <p class="text-success">Jurnal sudah divalidasi</p>
                            @elseif($item->validasi == 'ditolak')
                                <p class="text-danger">Jurnal ditolak</p>
                            @else
                                <p class="text-primary">Belum di validasi</p>
                            @endif
                        </dd>
                    </dl>
                </div>
                <div class="custom-modal-footer">

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('validasisetuju', $item->id) }}" class="btn btn-primary mx-1"
                            data-id="{{ $item->id }}">
                            Setuju
                        </a>
                        <a href="{{ route('validasiditolak', $item->id) }}" class="btn btn-danger mx-1"
                            data-id="{{ $item->id }}">
                            Tolak
                        </a>
                        <button type="button" class="btn btn-secondary mx-1"
                            onclick="closeModal({{ $item->id }})">Keluar</button>
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
    @foreach ($siswa as $item)
        <div class="custom-modal-backdrop1" id="modalBackdrop1{{ $item->id }}" style="display: none;"></div>
        <div class="custom-modal1" id="modal1{{ $item->id }}" style="display: none; overflow-y: auto;">
            <div class="modal-content1">
                <div class="custom-modal-header1">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title1">Validasi Jurnal</h5>

                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="custom-close-btn1"
                                    onclick="closeModal1({{ $item->id }})">&times;</button>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>
                <div class="modal-body1">

                    <div class="text-center">
                        <p>Status Jurnal:</p>
                        @if ($item->validasi == 'tervalidasi')
                            <p class="text-success">Jurnal sudah divalidasi</p>
                        @elseif($item->validasi == 'ditolak')
                            <p class="text-danger">Jurnal ditolak</p>
                        @else
                            <p class="text-primary">Belum di validasi</p>
                        @endif
                    </div>
                    
                        
                    <p class="text-muted" style="font-size: 12px">Note: <br> Pilih "Setuju" untuk mengonfirmasi jurnal ini.
                        <br>Pilih "Tolak" jika ada ketidaksesuaian dengan kriteria yang ditentukan.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('validasisetuju', $item->id) }}"
                            class="btn1 btn btn-success mx-1 validate-btn1" data-id="{{ $item->id }}">
                            Setuju
                        </a>
                        <a href="{{ route('validasiditolak', $item->id) }}"
                            class="btn btn1 btn-danger tolakvalidate-btn1" data-id="{{ $item->id }}">
                            Tolak
                        </a>
                    </div>

                </div>

            </div>

        </div>
    @endforeach

    <script>
        function openModal1(id) {
            document.getElementById('modal1' + id).style.display = 'block';
            document.getElementById('modalBackdrop1' + id).style.display = 'block';
        }

        function closeModal1(id) {
            document.getElementById('modal1' + id).style.display = 'none';
            document.getElementById('modalBackdrop1' + id).style.display = 'none';
        }

        // Close modal when clicking outside of it
        document.addEventListener('click', function(event) {
            if (event.target.matches('.custom-modal-backdrop1')) {
                const modals = document.querySelectorAll('.custom-modal1');
                modals.forEach((modal) => {
                    if (event.target.id === 'modalBackdrop1' + modal.id.replace('modal1', '')) {
                        closeModal(modal.id.replace('modal1', ''));
                    }
                });
            }
        });
    </script>
</div>

@endsection

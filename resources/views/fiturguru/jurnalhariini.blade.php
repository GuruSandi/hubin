@extends('template.sidebar1')
@section('title', 'Jurnal Siswa Hari Ini')

@section('content')

    <div class="container mt-4">
       
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Jurnal Siswa Hari Ini</p>
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
                                    @foreach ($jurnalsiswa as $item)
                                        <tr onclick="openModal({{ $item->id }})">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->kelas_siswa }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td style="width: 400px">{{ $item->deskripsi_jurnal }}</td>
                                            <td>{{ $item->instansi }}</td>
                                            <td>{{ $item->nama_pembimbing }}</td>
                                            <td style="width: 100px" class="text-center">
    
                                                @if ($item->validasi == 'tervalidasi')
                                                    <button type="button" class="btn btn-sm mx-1 btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="fas fa-check"></i>
    
                                                    </button>
                                                @elseif($item->validasi == 'ditolak')
                                                    <button type="button" class="btn btn-sm mx-1 btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="fas fa-times"></i>
    
                                                    </button>
                                                @else
                                                    
                                                        <a href="{{ route('validasisetuju', $item->id) }}" class="btn btn-sm btn-success mx-1 validate-btn" data-id="{{ $item->id }}">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        <a href="{{ route('validasiditolak', $item->id) }}" class="btn btn-sm btn-danger tolakvalidate-btn" data-id="{{ $item->id }}">
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
            </div>
        </div>
        @foreach ($jurnalsiswa as $item)
            <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
            <div class="custom-modal" id="modal{{ $item->id }}" style="display: none; overflow-y: auto">
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

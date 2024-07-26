@extends('template.sidebar1')
@section('title', 'Nilai Siswa')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Nilai Siswa</p>
                        <div class="row mb-3">
                            <div class="col-3">
                                <button class="btn btn-sm btn-primary text-white"  onclick="openModal()">
                                    <i class="bi bi-plus-circle"></i> Tambah Nilai
                                </button>


                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-bordered" id="example"
                                style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Nilai 1</th>
                                        <th>Nilai 2</th>
                                        <th>Nilai 3</th>
                                        <th>Nilai 4</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaisiswa as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td onclick="openModal({{ $item->id }})">{{ $item->siswa->nama }}</td>
                                            <td>{{ $item->siswa->kelas }}</td>
                                            <td>{{ $item->nilai1 }}</td>
                                            <td>{{ $item->nilai2 }}</td>
                                            <td>{{ $item->nilai3 }}</td>
                                            <td>{{ $item->nilai4 }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm mx-1 btn-success"
                                                    onclick="openModal({{ $item->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm mx-1 btn-warning text-white"
                                                    onclick="openModal({{ $item->id }})">
                                                    <i class="fas fa-edit"></i>

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
        @foreach ($nilaisiswa as $item)
            <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
            <div class="custom-modal" id="modal{{ $item->id }}" style="display: none;">
                <div class="custom-modal-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title">Detail Nilai Siswa</h5>

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
                        <dd class="col-sm-8">{{ $item->siswa->nama }}</dd>
                        <dt class="col-sm-4">Kelas</dt>
                        <dd class="col-sm-8">{{ $item->siswa->kelas }}</dd>
                        <dt class="col-sm-4">Nilai 1</dt>
                        <dd class="col-sm-8">{{ $item->nilai1 }}</dd>
                        <dt class="col-sm-4">Nilai 2</dt>
                        <dd class="col-sm-8">{{ $item->nilai2 }}</dd>
                        <dt class="col-sm-4">Nilai 3</dt>
                        <dd class="col-sm-8">{{ $item->nilai3 }}</dd>
                        <dt class="col-sm-4">Nilai 4</dt>
                        <dd class="col-sm-8">{{ $item->nilai4 }}</dd>

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
        @include('fiturguru.nilaisiswa.tambahnilaisiswa')
        <script>
            // Fungsi untuk membuka modal
            function openModal() {
                document.querySelector('.custom-modal-tambah').style.display = 'block';
                document.querySelector('.custom-modal-backdrop').style.display = 'block';
            }
        
            // Fungsi untuk menutup modal
            function closeModal() {
                document.querySelector('.custom-modal-tambah').style.display = 'none';
                document.querySelector('.custom-modal-backdrop').style.display = 'none';
            }
        
            // Tutup modal ketika klik di luar modal
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('custom-modal-backdrop')) {
                    closeModal();
                }
            });
        </script>
        
    </div>

@endsection

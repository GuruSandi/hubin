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
                        <div class="col-md-12 col-lg-12">
                            <button class="btn btn-sm btn-primary text-white" onclick="openAddModal()">
                                <i class="bi bi-plus-circle"></i> Tambah Nilai
                            </button>
                            <a href="{{ route('exportnilaisiswa') }}" class="btn btn-sm btn-success"> <i
                                class="bi bi-file-excel"></i> Export Excel</a>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Internalisasi dan Penerapan Soft Skills</th>
                                    <th>Penerapan Hard Skills</th>
                                    <th>Peningkatan dan Pengembangan Hard Skills</th>
                                    <th>Penyiapan Kemandirian Berwirausaha</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilaisiswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td onclick="openDetailModal({{ $item->id }})">{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->siswa->kelas }}</td>
                                        <td>{{ $item->nilai1 }}</td>
                                        <td>{{ $item->nilai2 }}</td>
                                        <td>{{ $item->nilai3 }}</td>
                                        <td>{{ $item->nilai4 }}</td>
                                        <td style="width: 100px">
                                            <button type="button" class="btn btn-sm mx-1 btn-success" onclick="openDetailModal({{ $item->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm mx-1 btn-warning text-white" onclick="openEditModal({{ $item->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('fiturguru.nilaisiswa.editnilaisiswa')

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
                            <button type="button" class="custom-close-btn" onclick="closeModal({{ $item->id }})">&times;</button>
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
                    <dt class="col-sm-8 mt-3">Mata Pelajaran</dt>
                    <dt class="col-sm-4 mt-3">Nilai</dt>
                    <hr>
                    <dt class="col-sm-8">Internalisasi dan Penerapan Soft Skills</dt>
                    <dd class="col-sm-4">{{ $item->nilai1 }}</dd>
                    <dt class="col-sm-8">Penerapan Hard Skills</dt>
                    <dd class="col-sm-4">{{ $item->nilai2 }}</dd>
                    <dt class="col-sm-8">Peningkatan dan Pengembangan Hard Skills</dt>
                    <dd class="col-sm-4">{{ $item->nilai3 }}</dd>
                    <dt class="col-sm-8">Penyiapan Kemandirian Berwirausaha</dt>
                    <dd class="col-sm-4">{{ $item->nilai4 }}</dd>
                </dl>
            </div>
            <div class="custom-modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" onclick="closeModal({{ $item->id }})">Close</button>
                </div>
            </div>
        </div>
    @endforeach

    @include('fiturguru.nilaisiswa.tambahnilaisiswa')

    <script>
        function openDetailModal(id) {
            document.getElementById('modal' + id).style.display = 'block';
            document.getElementById('modalBackdrop' + id).style.display = 'block';
        }
    
        function closeModal(id) {
            document.getElementById('modal' + id).style.display = 'none';
            document.getElementById('modalBackdrop' + id).style.display = 'none';
        }
    
        function openEditModal(id) {
            document.getElementById('editModal' + id).style.display = 'block';
            document.getElementById('editModalBackdrop' + id).style.display = 'block';
        }
    
        function closeEditModal(id) {
            document.getElementById('editModal' + id).style.display = 'none';
            document.getElementById('editModalBackdrop' + id).style.display = 'none';
        }
    
        function openAddModal() {
            document.getElementById('tambah-nilai').style.display = 'block';
            document.getElementById('modalBackdropAdd').style.display = 'block';
        }
    
        function closeAddModal() {
            document.getElementById('tambah-nilai').style.display = 'none';
            document.getElementById('modalBackdropAdd').style.display = 'none';
        }
    
        document.addEventListener('click', function(event) {
            if (event.target.matches('.custom-modal-backdrop')) {
                const modals = document.querySelectorAll('.custom-modal');
                modals.forEach((modal) => {
                    if (event.target.id === 'modalBackdrop' + modal.id.replace('modal', '')) {
                        closeModal(modal.id.replace('modal', ''));
                    }
                });
                if (event.target.id === 'modalBackdropAdd') {
                    closeAddModal();
                }
            }
        });
    </script>
    
@endsection

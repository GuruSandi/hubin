@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold mb-4">Data Siswa</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Instansi</th>
                                    <th>Pembimbing</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr onclick="openModal({{ $item->id }})">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas_siswa }}</td>
                                        <td>{{ $item->instansi }}</td>
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

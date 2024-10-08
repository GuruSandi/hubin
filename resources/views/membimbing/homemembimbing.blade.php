@extends('template.sidebar')
@section('title', 'Home Membimbing')

@section('content')
    <div class=" mt-5">
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-4">Membimbing</h5>
            <div class="row mb-3">
                <div class="col-12">
                    <div id="toggleImport" class="btn btn-warning text-white">
                        <i class="bi-cloud-download-fill"></i> Import
                    </div>

                        <a href="{{ route('exportDataMembimbing') }}" class="btn btn-success"> <i
                            class="bi bi-file-earmark-excel"></i> Export</a>

                        <a href="{{ route('tambahmembimbing') }}" class="btn btn-primary"> <i
                            class="bi bi-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="row mt-3">
                <div id="importtoggle" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="text-muted">Note: Untuk format import header atau judul jangan diganti!</p>
                            <a href="{{ route('unduhformatmembimbing') }}" class="btn btn-success">
                                <i class="bi bi-download"></i> Unduh Format
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <form action="{{ route('importmembimbing') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <input type="file" name="file" class="form-control" required>
        
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-warning text-white"><i class="bi bi-cloud-download-fill"></i>
                                        Import</button>
        
                                </div>
                                
                            </div>
                        </form>
        
                    </div>
                </div>
            </div>
            

            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Hapus Semua Select</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select_all_ids">
                                    </th>
                                    <th>ID</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Guru Pembimbing</th>
                                    <th>Nama Guru Mapel PKL</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membimbing_sorted as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids" class="checkbox_ids" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->siswa->nis }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->pembimbing->nama }}</td>
                                        <td>{{ $item->guru_mapel_pkl->nama }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-book " style="color: white"></i>
                                                </button>
                                                <a href="{{ route('editmembimbing', $item->id) }}"
                                                    class="btn mx-1" style="background-color: #080761"> <i class="bi bi-pencil "
                                                        style="color: white"></i></a>
                                                <a href="{{ route('hapusmembimbing', $item->id) }}"
                                                    class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @include('membimbing.detailmembimbing')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select/Deselect All Checkboxes
            $("#select_all_ids").click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });
    
            // Delete All Selected Records
            $('#deleteAllSelectedRecord').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function() {
                    all_ids.push($(this).val());
                });
    
                if (all_ids.length === 0) {
                    alert('Please select at least one record.');
                    return;
                }
    
                // SweetAlert2 confirmation
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('membimbing.delete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('input:checkbox[name=ids]:checked').each(
                                    function() {
                                        $(this).closest('tr').remove();
                                    });
                                    location.reload();
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        'Failed to delete records.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete records. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
   

@endsection

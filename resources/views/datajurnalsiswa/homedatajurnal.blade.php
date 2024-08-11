@extends('template.sidebar')
@section('title', 'Home Data Jurnal Siswa')

@section('content')
    <div class=" mt-5 mb-5">

        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-4">Data Jurnal Siswa</h5>
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Hapus Semua Select</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered" id="example" style="font-size: 10px">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select_all_ids">
                                    </th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi Jurnal</th>
                                    <th>Instansi</th>
                                    <th>Pembimbing</th>
                                    <th>Guru Mapel PKL</th>
                                    <th>Status Jurnal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datajurnal as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids" class="checkbox_ids"
                                                value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas_siswa }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td style="width: 300px">{{ $item->deskripsi_jurnal }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->nama_pembimbing }}</td>
                                        <td>{{ $item->nama_gurumapel }}</td>
                                        <td>
                                            @if ($item->validasi == 'belum_tervalidasi')
                                                <p class="text-white bg-warning px-1"
                                                    style="font-size: 11px ; border-radius: 10px">
                                                    Belum divalidasi</p>
                                            @elseif ($item->validasi == 'ditolak')
                                                <p class="text-white bg-danger px-1"
                                                    style="font-size: 11px ; border-radius: 10px">
                                                    Ditolak</p>
                                            @elseif ($item->validasi == 'tervalidasi')
                                                <p class="text-white bg-success px-1"
                                                    style="font-size: 11px ; border-radius: 10px">
                                                    Sudah divalidasi</p>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-book " style="color: white"></i>
                                                </button>
                                                <button type="button" style="background-color: #080761" class="btn mx-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bi bi-pencil " style="color: white"></i>
                                                </button>
                                                <a href="{{ route('hapusdatajurnalsiswa', $item->id) }}"
                                                    class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                    @include('datajurnalsiswa.detaildatajurnal')
                                    @include('datajurnalsiswa.editdatajurnalsiswa')
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
                            url: "{{ route('datajurnal.delete') }}",
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

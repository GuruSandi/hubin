@extends('template.sidebar')
@section('title', 'Home Absensi Siswa')

@section('content')
    <div class=" mt-5 mb-5">

        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-4">Data Absensi Siswa</h5>
            

            <!-- Delete All Selected Records -->
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <div id="toggleImport" class="btn btn-warning text-white">
                        <i class="bi bi-funnel"></i> Filter Tanggal
                    </div>
                    <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Hapus Semua Select</a>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div id="importtoggle" style="display: none;">
                    
                    <form action="{{ route('searchdataabsensisiswa') }}" method="GET" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" name="search" class="form-control " placeholder="nama siswa atau guru mapel PKL" value="{{ request('search') }}">

                            </div>
                            <div class="col-2">
                                <input type="date" name="start_date" class="form-control me-2 mb-2 mb-md-0" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-2">
                                <input type="date" name="end_date" class="form-control me-2 mb-2 mb-md-0" value="{{ request('end_date') }}">
                                
                            </div>
                            <div class="col-4 ">
                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                               

                            </div>
    
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered" id="" style="font-size: 10px">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select_all_ids">
                                    </th>
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
                                    <th>Guru Mapel PKL</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensisiswa as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids" class="checkbox_ids"
                                                value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $loop->iteration + ($absensisiswa->currentPage() - 1) * $absensisiswa->perPage() }}</td>

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
                                            @elseif ($item->keterangan == 'tidak_hadir_pkl')
                                                Tidak Masuk PKL
                                            @elseif ($item->keterangan == 'absen')
                                                Alpa
                                            @endif
                                        </td>
                                        <td>{{ $item->nama_pembimbing }}</td>
                                        <td>{{ $item->nama_gurumapel }}</td>
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
                                                <a href="{{ route('hapusdataabsensisiswa', $item->id) }}"
                                                    class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                    @include('dataabsensisiswa.detaildataabsensisiswa')
                                    @include('dataabsensisiswa.editdataabsensisiswa')
                                @endforeach
                            </tbody>
                        </table>
                        {{ $absensisiswa->links() }}

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
                            url: "{{ route('dataabsensi.delete') }}",
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

@extends('template.sidebar')
@section('title', 'Setting')

@section('content')
    <div class="row mt-3">

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <h5 class="fw-bold mt-2">Data Siswa Aktif</h5>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <a href="#" class="btn btn-danger" id="nonaktifAllSelectedRecord">Tidak Aktif</a>
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
                                        <th>Nama</th>
                                        <th>P/L</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswaaktif as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ids" class="checkbox_ids"
                                                    value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenkel }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->tahun_ajar }}</td>
                                            <td>
                                                @if ($item->status == 'aktif')
                                                    <p class="text-white bg-success px-1 text-center"
                                                        style="font-size: 11px ; border-radius: 10px">
                                                        Aktif</p>
                                                @elseif($item->status == 'tidak_aktif')
                                                    <p class="text-white bg-danger px-1 text-center"
                                                        style="font-size: 11px ; border-radius: 10px">
                                                        Tidak Aktif</p>
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
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <h5 class="fw-bold mt-2">Data Siswa Tidak Aktif</h5>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <a href="#" class="btn btn-success" id="aktifAllSelectedRecord">Aktifkan</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-8">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="examplee" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select_all_id">
                                        </th>
                                        <th>ID</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>P/L</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswanonaktif as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id" class="checkbox_id"
                                                    value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenkel }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->tahun_ajar }}</td>
                                            <td>
                                                @if ($item->status == 'aktif')
                                                    <p class="text-white bg-success px-1 text-center"
                                                        style="font-size: 11px ; border-radius: 10px">
                                                        Aktif</p>
                                                @elseif($item->status == 'tidak_aktif')
                                                    <p class="text-white bg-danger px-1 text-center"
                                                        style="font-size: 11px ; border-radius: 10px">
                                                        Tidak Aktif</p>
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
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3 fw-bold" style="color: #080761">Profile</h6>
                        <hr>
                        <form action="{{ route('posteditprofile', $user->id) }}" class="form-group"
                            enctype="multipart/form-data" method="POST">
                            @csrf

                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control form-control-sm " required name="username"
                                id="username" value="{{ $user->username }}">


                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" required name="password"
                                id="password" value="{{ $user->password }}">


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3 fw-bold" style="color: #080761">Backup dan Reset Data</h6>
                    <hr>
                    <p class="card-title mb-3 fw-bold" style="color: #080761">Perhatian!</p>
                    <p>
                        Backup Data dilakukan setiap hari tetapi untuk backup data langsung bisa dilakukan dengan klik "Backup" dibawah ini untuk Reset Data akan muncul setelah Anda melakukan Backup.
                    </p>
                    
                    

                </div>
            </div>
        </div>
    </div> --}}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            // Select/Deselect All Checkboxes
            $("#select_all_ids").click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });

            // Validate All Selected Records
            $('#nonaktifAllSelectedRecord').click(function(e) {
                e.preventDefault();

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin Menonaktifkan semua siswa yang dipilih?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lakukan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var all_ids = [];
                        $('input:checkbox[name=ids]:checked').each(function() {
                            all_ids.push($(this).val());
                        });

                        if (all_ids.length === 0) {
                            Swal.fire('Peringatan', 'Silakan pilih setidaknya satu siswa.',
                                'warning');
                            return;
                        }

                        $.ajax({
                            url: "{{ route('setting.nonaktif') }}", // Make sure this route is correct
                            type: "POST", // Use POST to update records
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('input:checkbox[name=ids]:checked').each(
                                    function() {
                                        $(this).closest('tr').find('td:eq(9)')
                                            .html(
                                                '<p class="text-white bg-success px-1" style="font-size: 11px; border-radius: 10px">Tervalidasi</p>'
                                            );
                                    });
                                    Swal.fire('Sukses', 'Data berhasil divalidasi.',
                                        'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal', 'Gagal memvalidasi data.',
                                        'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal',
                                    'Gagal memvalidasi data. Silakan coba lagi.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Select/Deselect All Checkboxes
            $("#select_all_id").click(function() {
                $('.checkbox_id').prop('checked', $(this).prop('checked'));
            });

            // Validate All Selected Records
            $('#aktifAllSelectedRecord').click(function(e) {
                e.preventDefault();

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin Mengaktifkan semua siswa yang dipilih?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lakukan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var all_ids = [];
                        $('input:checkbox[name=id]:checked').each(function() {
                            all_ids.push($(this).val());
                        });

                        if (all_ids.length === 0) {
                            Swal.fire('Peringatan', 'Silakan pilih setidaknya satu siswa.',
                                'warning');
                            return;
                        }

                        $.ajax({
                            url: "{{ route('setting.aktifkan') }}", // Make sure this route is correct
                            type: "POST", // Use POST to update records
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('input:checkbox[name=id]:checked').each(
                                function() {
                                        $(this).closest('tr').find('td:eq(9)')
                                            .html(
                                                '<p class="text-white bg-success px-1" style="font-size: 11px; border-radius: 10px">Tervalidasi</p>'
                                            );
                                    });
                                    Swal.fire('Sukses', 'Data berhasil divalidasi.',
                                        'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal', 'Gagal memvalidasi data.',
                                        'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal',
                                    'Gagal memvalidasi data. Silakan coba lagi.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection

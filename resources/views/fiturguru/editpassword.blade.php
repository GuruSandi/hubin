@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

    <div class="container mt-4">

        <div class="row g-2">
            <div class="col-md-6 col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="fw-bold ">Ganti Foto</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img id="previewFoto" src="{{ asset($guru_mapel_pkl->foto) }}" alt="" width="100"
                                    height="100">
                                
                            </div>
                            <div class="col-8">
                                <p>Nama <br> {{ $guru_mapel_pkl->nama }}</p>
                                <p>No Handphone <br> {{ $guru_mapel_pkl->no_hp }}</p>
                                <form action="{{ route('dashboardguru.editfoto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" accept="img/fotoguru/*" class="form-control form-control-sm "
                                        name="foto" id="foto" onchange="previewFile()">
                                    <button type="submit" class="btn btn-sm btn-primary mt-3 text-white">Simpan</button>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="fw-bold ">Edit Password</p>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboardguru.changepassword') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control form-control-sm" required>
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" name="new_password" id="new_password"
                                    class="form-control form-control-sm" required>
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control form-control-sm" required>
                                @error('new_password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mt-3 text-white">Simpan</button>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
        function previewFile() {
            const preview = document.getElementById('previewFoto');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endsection

@extends('template.navbar')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Lokasi Instansi</div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('simpanlokasi') }}" class="form-group"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                            </div>

                            <!-- Tambahkan elemen tambahan sesuai kebutuhan, seperti tombol untuk mendapatkan lokasi -->

                            <button type="submit" class="btn btn-primary">Simpan Lokasi Instansi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            });
        });
    </script>
@endsection

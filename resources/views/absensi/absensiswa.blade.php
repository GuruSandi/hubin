@extends('template.navbar')
@section('title', 'Absensi Datang')

@section('content')

    <div class="container mt-5">
        <div class="card col-12 shadow mx-auto p-4">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <h4 class="text-center mb-5 fw-bold">Absensi Datang</h4>
            <form action="{{ route('postabsensi') }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                <label for="">Keterangan:</label>
                <select name="keterangan" class="form-control" required>
                    <option value="hadir">Hadir</option>
                    <option value="libur">Libur</option>
                </select><br>

                <!-- Tambahkan input tersembunyi untuk menyimpan koordinat latitude dan longitude -->
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <button type="submit" class="btn btn-primary">Absen</button>
            </form>
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

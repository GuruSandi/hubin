@extends('template.navbar')
@section('title', 'Absensi Datang')

@section('content')
    <div class="section" id="bg">
        <h4 class="text-white">Absensi Datang</h4>
        
        
    </div>
    <div class="section">
        <div class="mt-3">
            <div class="card" style="border-radius: 10px">
                <div class="card-body ">
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
        </div>
    </div>
    {{-- <div class="container mt-5">
        <div class="card col-12 shadow mx-auto p-4">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            
        </div>
    </div> --}}

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
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/locale/id.js"></script>

    <script>
        var waktuSekarang = moment().locale('id').format('HH:mm:ss');
        // document.getElementById('waktu-sekarang').textContent = waktuSekarang;
        document.getElementById('waktu-sekarang').value = latitude;
    </script>
    <script>
        var tanggalSekarang = moment().locale('id').format('dddd, D MMMM YYYY');
        document.getElementById('tanggal-sekarang').textContent = tanggalSekarang;
    </script>
@endsection

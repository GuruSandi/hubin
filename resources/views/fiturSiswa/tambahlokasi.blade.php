@extends('template.nav')
@section('title', 'Simpan Lokasi Instansi')

@section('content')
    <div id="bg">
       <div class="container">
        <div style="width: 40px">
            <a href="{{ route('dashboardsiswa') }}">
                <div style="background-color: #faac05; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                    class="text-center text-white"> <i class="bi bi-arrow-left bi-lg"></i>
                </div>
            </a>
        </div>
        
        <h4 class="text-white mt-3">Simpan Lokasi Instansi</h4>
        <p style="font-size: 12px" class="text-white">Pastikan lokasi instansi tersimpan dengan detail untuk memastikan aksesibilitas dan efisiensi yang optimal.</p>

       </div>
    </div>
    <div id="menu-form">
        <div class="mt-3">
            <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
                <div class="container mt-3 ">
                    <form method="POST" action="{{ route('simpanlokasi') }}" class="form-group"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" required id="latitude" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" required id="longitude" class="form-control" readonly>
                            </div>
                            <button class="btn w-100 text-white" style="border-radius: 20px; background-color: #080761">Simpan</button>

                        </form>



                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol izin lokasi
            var getLocationBtn = document.getElementById('getLocationBtn');
    
            // Event listener untuk klik tombol
            getLocationBtn.addEventListener('click', function() {
                // Minta izin untuk mendapatkan lokasi
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    alert('Lokasi Anda: ' + latitude + ', ' + longitude);
                }, function(error) {
                    console.error('Gagal mendapatkan lokasi:', error);
                    alert('Gagal mendapatkan lokasi: ' + error.message);
                });
            });
        });
    </script>
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



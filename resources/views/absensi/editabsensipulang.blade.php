@extends('template.nav')
@section('title', 'Absensi Pulang')

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
       
        <h4 class="text-white mt-3">Absensi Pulang</h4>
        <p style="font-size: 12px" class="text-white">Silahkan melakukan Absensi Pulang pilih salah satu keterangan hadir, libur dan
            tidak masuk PKL</p>
    </div>
</div>
<div class="" id="menu-form">
    <div class="mt-3">
        <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
            <div class="container mt-3">
                <form action="{{ route('posteditabsensipulang', $absensisiswa->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="">Tanggal:</label>
                    <p>{{ $tanggal }}</p>
                    <label for="">Jam:</label>
                    <p>{{ $jam_pulang }}</p>
                    <label for="">Keterangan:</label>
                    <select name="keterangan" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="libur">Libur</option>
                    </select><br>
                    
    
                    <!-- Tambahkan input tersembunyi untuk menyimpan koordinat latitude dan longitude -->
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
    
                    <button type="submit" class="btn w-100 text-white" style="border-radius: 20px; background-color: #080761">Simpan</button>

                </form>
               
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

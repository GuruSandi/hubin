@extends('template.navbar')
@section('title', 'Absensi Pulang')

@section('content')
<div class="section" id="bg">
    <a href="{{ route('dashboardsiswa') }}">
        <div style="background-color: #fff; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
            class="text-center text-dark"> <i class="bi bi-arrow-left bi-lg"></i>
        </div>
    </a>
    <h4 class="text-white mt-3">Absensi Pulang</h4>
    <p style="font-size: 12px" class="text-white">Silakan lengkapi jurnal dengan menuliskan pengalaman atau pembelajaran penting hari ini sebelum mengirimkan absensi pulang.</p>


</div>
<div class="" id="menu-form">
    <div class="mt-3">
        <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
            <div class="card-body ">
                <form action="{{ route('postabsensipulang', $absensisiswa->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="">Tanggal:</label>
                    <p>{{ $tanggal }}</p>
                    <label for="">Jam:</label>
                    <p>{{ $jamsekarang }}</p>
                    
                    <label for="">Keterangan:</label>
                    <select name="keterangan" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="libur">Libur</option>
                    </select><br>
                    <label for="">Deskripsi Jurnal:</label>
                    <div class="form-floating">
                        <textarea class="form-control" name="deskripsi_jurnal" required placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px"></textarea>
                      </div>
                    
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
    
                    <button type="submit" class="btn w-100 text-white mt-4" style="border-radius: 20px; background-color: #080761">Simpan</button>

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

@extends('template.navbar')
@section('title', 'Absensi Pulang')

@section('content')
<div class="section" id="bg">
    <h4 class="text-white">Absensi Pulang</h4>
    
    
</div>
<div class="section">
    <div class="mt-3">
        <div class="card" style="border-radius: 10px">
            <div class="card-body ">
                <form action="{{ route('postabsensipulang', $absensisiswa->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="">Keterangan:</label>
                    <select name="keterangan" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="libur">Libur</option>
                    </select><br>
                    <label for="">Deskripsi Jurnal:</label>
                    <div class="form-floating">
                        <textarea class="form-control" name="deskripsi_jurnal" required placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px"></textarea>
                      </div>
                    {{-- <input type="text" name="deskripsi_jurnal" class="form-control mb-3" id="" required> --}}
    
                    <!-- Tambahkan input tersembunyi untuk menyimpan koordinat latitude dan longitude -->
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
    
                    <button type="submit" class="btn btn-primary mt-3">Absen</button>
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

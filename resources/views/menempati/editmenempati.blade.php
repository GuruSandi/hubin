<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit data Penempatan</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <style>
        /* Tambahkan CSS untuk garis di awal formulir */
        .form-group label::before {
            content: "";
            display: block;
            width: 2px; /* Lebar garis */
            background-color: #ccc; /* Warna garis */
            margin-right: 10px; /* Jarak antara garis dan teks */
        }
        .dropdown-long-list .select2-results__option {
            display: block; /* Mengatur opsi untuk ditampilkan sebagai blok */
            width: 100%; /* Memenuhi lebar dropdown */
            white-space: normal; /* Memastikan teks tidak terpotong */
        }

    </style>
</head>
<body>
    @include('template.nav')

    <div class="container mt-5 mb-5">
        <div class="card mx-auto p-5 col-md-8 shadow">
            <h4 class="text-center mb-5 fw-bold">Edit Data Penempatan</h4>
            <form action="{{route('posteditmenempati', $menempati->id)}}"  enctype="multipart/form-data" method="POST">
                @csrf
                <label for="">Instansi</label>
                <select class=" form-control" id="instansi" name="instansi_id">
                    @foreach ($instansi as $item)
                        <option value="{{ $item->id }} @if (in_array($item->id, $selectinstansi)) selected @endif">{{ $item->instansi }}</option>
                    @endforeach
                </select>
            
                <label for="">Pilih Siswa</label>

                <select class=" form-control" id="siswa" name="siswa_ids[]" multiple="multiple">
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id }}" @if (in_array($item->id, $selectsiswa)) selected @endif>{{ $item->nama }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary w-100 mt-2">Submit</button>
            </form>
        </div>
    </div>
    
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
        $(document).ready(function() {
        // Inisialisasi Select2 untuk instansi
        $('#instansi').select2({
          
            placeholder: "Select an option",
            allowClear: true
        });

        // Inisialisasi Select2 untuk siswa
        $('#siswa').select2({
        
            placeholder: "Select an option",
            allowClear: true,
        });
    });

</script>

</body>
</html>
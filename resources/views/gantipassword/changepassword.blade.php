@extends('template.nav')
@section('title', 'Edit Password')

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
       
        <h4 class="text-white mt-3">Edit Password</h4>
        <p style="font-size: 12px" class="text-white">Silakan periksa kembali jurnal Anda dengan cermat untuk memastikan keseluruhan isi telah disampaikan dengan jelas dan tepat.</p>

       </div>
    </div>
    <div id="menu-form">
        <div class="mt-3">
            <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
                <div class="container mt-3 ">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf

                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="form-control"
                                required>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                            @error('new_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control" required>
                            @error('new_password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button class="btn w-100 text-white" style="border-radius: 20px; background-color: #080761">Simpan</button>

                    </form>


                </div>
            </div>
        </div>
    </div>





@endsection

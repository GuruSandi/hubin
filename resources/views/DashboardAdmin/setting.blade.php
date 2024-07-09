@extends('template.sidebar')
@section('title', 'Setting')

@section('content')
<div class="row mt-3">

   
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3 fw-bold" style="color: #080761">Profile</h6>
                    <hr>
                    <form action="{{ route('posteditprofile', $user->id) }}" class="form-group"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-sm " required name="username" id="username"
                            value="{{ $user->username }}">

                       
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm" required name="password" id="password"
                            value="{{ $user->password }}">

                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3 fw-bold" style="color: #080761">Backup dan Reset Data</h6>
                    <hr>
                    <p class="card-title mb-3 fw-bold" style="color: #080761">Perhatian!</p>
                    <p>
                        Backup Data dilakukan setiap hari tetapi untuk backup data langsung bisa dilakukan dengan klik "Backup" dibawah ini untuk Reset Data akan muncul setelah Anda melakukan Backup.
                    </p>
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection

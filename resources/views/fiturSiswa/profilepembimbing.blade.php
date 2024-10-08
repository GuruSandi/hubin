@extends('template.navbar')
@section('title', 'Profile Pembimbing')

@section('content')

    <div id="bgprofileguru">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-white text-center mt-3">Profile Pembimbing</h4>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="avatar">
                            <img src="{{ asset($membimbing->pembimbing->foto ?? '/img/account.jpg') }}" alt="avatar" class="imaged w100 rounded">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi  bi-person-fill text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">Nama Guru Mapel PKL</label>
                <p>{{ $membimbing->pembimbing->nama ?? 'Belum Ditempatkan'  }}</p>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-telephone text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">No HandPhone</label>
                <p>{{ $membimbing->pembimbing->no_hp ?? 'Belum Ditempatkan'  }}</p>
            </div>
        </div>
        <hr>
        
    </div>
@endsection

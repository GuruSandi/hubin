<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel_pkl;
use App\Models\membimbing;
use App\Models\nilai_pkl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiSiswaController extends Controller
{
    public function nilaisiswa()
    {
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = membimbing::where('guru_mapel_pkl_id', $guru_mapel_pkl->id)
        ->with('siswa')->get();
        $nilaisiswa = nilai_pkl::where('guru_mapel_pkl_id', $guru_mapel_pkl->id)->with('siswa')->get();
        
        // dd($nilaisiswa);
        return view('fiturguru.nilaisiswa.nilaisiswa', compact('siswa', 'nilaisiswa', 'guru_mapel_pkl'));
    }
}

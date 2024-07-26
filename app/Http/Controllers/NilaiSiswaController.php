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
        $siswa_terpilih = nilai_pkl::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswa->whereNotIn('id', $siswa_terpilih);
        // dd($nilaisiswa);
        return view('fiturguru.nilaisiswa.nilaisiswa', compact('siswa', 'nilaisiswa', 'guru_mapel_pkl','siswa_tersedia'));
    }
    public function posttambahnilaisiswa(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required',
            'guru_mapel_pkl_id' => 'required',
            'nilai1' => 'required|numeric',
            'nilai2' => 'required|numeric',
            'nilai3' => 'required|numeric',
            'nilai4' => 'required|numeric',

        ]);
        nilai_pkl::create([
            'siswa_id' => $request->siswa_ids,
            'guru_mapel_pkl_id' => $request->guru_mapel_pkl_id,
            'user_id' => Auth::id(),
            'nilai1' => $request->nilai1,
            'nilai2' => $request->nilai2,
            'nilai3' => $request->nilai3,
            'nilai4' => $request->nilai4,
        ]);
        toastr()->success('Data berhasil ditambahkan!');
        return view('fiturguru.nilaisiswa.nilaisiswa', compact('siswa', 'nilaisiswa', 'guru_mapel_pkl','siswa_tersedia'));
    }
    public function editnilaisiswa(Request $request, nilai_pkl $nilai_pkl)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'guru_mapel_pkl_id' => 'required|exists:guru_mapel_pkls,id',
            'nilai1' => 'required|numeric',
            'nilai2' => 'required|numeric',
            'nilai3' => 'required|numeric',
            'nilai4' => 'required|numeric',

        ]);
        $nilai_pkl->update([
            'siswa_id' => $request->siswa_ids,
            'guru_mapel_pkl_id' => $request->guru_mapel_pkl_id,
            'user_id' => Auth::id(),
            'nilai1' => $request->nilai1,
            'nilai2' => $request->nilai2,
            'nilai3' => $request->nilai3,
            'nilai4' => $request->nilai4,
        ]);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

}

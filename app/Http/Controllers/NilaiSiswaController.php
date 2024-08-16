<?php

namespace App\Http\Controllers;

use App\Exports\NilaiSiswaExport;
use App\Models\guru_mapel_pkl;
use App\Models\membimbing;
use App\Models\nilai_pkl;
use App\Models\siswa;
use Maatwebsite\Excel\Facades\Excel;
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

        $siswa_terpilih = $nilaisiswa->pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswa->whereNotIn('id', $siswa_terpilih);
        return view('fiturguru.nilaisiswa.nilaisiswa', compact('siswa', 'nilaisiswa', 'guru_mapel_pkl','siswa_tersedia'));
    }
    public function posttambahnilaisiswa(Request $request)
    {
        
        $request->validate([
            'siswa_ids' => 'required',
            'guru_mapel_pkl_id' => 'required',
            'nilai1' => 'required|numeric|between:1,100',
            'nilai2' => 'required|numeric|between:1,100',
            'nilai3' => 'required|numeric|between:1,100',
            'nilai4' => 'required|numeric|between:1,100',

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
        return redirect()->route('nilaisiswa');
    }
    public function editnilaisiswa(Request $request, $id)
    {
        $nilai_pkl = nilai_pkl::findOrFail($id);
        // $this->authorize('update', $nilai_pkl);
        $data =$request->validate([
            'siswa_id' => 'required',
            'nilai1' => 'required|numeric|between:1,100',
            'nilai2' => 'required|numeric|between:1,100',
            'nilai3' => 'required|numeric|between:1,100',
            'nilai4' => 'required|numeric|between:1,100',

        ]);
        $nilai_pkl->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('nilaisiswa');

    }
    public function exportnilaisiswa()
    {
        return Excel::download(new NilaiSiswaExport, 'nilai_siswa.xlsx');
    }

}

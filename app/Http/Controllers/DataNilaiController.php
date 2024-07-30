<?php

namespace App\Http\Controllers;

use App\Models\nilai_pkl;
use Illuminate\Http\Request;

class DataNilaiController extends Controller
{
    public function datanilaisiswa()
    {
        $nilaisiswa = nilai_pkl::with('siswa')->get();

        return view('datanilaisiswa.homedatanilai', compact('nilaisiswa'));

    }
    public function posteditdatanilaisiswa(Request $request, nilai_pkl $nilai_pkl)
    {
       $data= $request->validate([
            'nilai1' => 'required|numeric|between:1,100',
            'nilai2' => 'required|numeric|between:1,100',
            'nilai3' => 'required|numeric|between:1,100',
            'nilai4' => 'required|numeric|between:1,100',
        ]);
        $nilai_pkl->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('datanilaisiswa');
    }
    public function hapusdatanilaisiswa( nilai_pkl $nilai_pkl)
    {
        $nilai_pkl->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('datanilaisiswa');


    }
}

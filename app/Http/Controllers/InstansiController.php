<?php

namespace App\Http\Controllers;

use App\Models\instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function homeinstansi()
    {
        $instansi = instansi::all();
        return view('instansi.homeinstansi', compact('instansi'));
    }
    public function tambahinstansi()
    {
        return view('instansi.tambahinstansi');
    }
    public function posttambahinstansi(Request $request)
    {
        $request->validate([
            'instansi' => 'required',
            'alamat' => 'required',
            'domisili' => 'required',
           
        ]);
        instansi::create([
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'domisili' => $request->domisili,
        ]);
        
        return redirect()->route('homeinstansi')->with('status', 'Berhasil Menambah data');
    }
    public function editinstansi(instansi $instansi)
    {
        return view('instansi.editinstansi', compact('instansi'));
    }
    public function posteditinstansi(Request $request, instansi $instansi)
    {
        $data =  $request->validate([
            'instansi' => 'required',
            'alamat' => 'required',
            'domisili' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
       
        $instansi->update($data);
        
        return redirect()->route('homeinstansi')->with('status', 'Berhasil Mengedit data');
    }
    public function hapusinstansi(instansi $instansi)
    {
        $instansi->delete();
      
        return redirect()->route('homeinstansi')->with('status', 'Berhasil Menghapus data');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\InstansiExport;
use App\Models\instansi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        toastr()->success('Data berhasil ditambahkan!');
        
        return redirect()->route('homeinstansi');
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
        toastr()->success('Data berhasil di update!');
        
        return redirect()->route('homeinstansi');
    }
    public function hapusinstansi(instansi $instansi)
    {
        $instansi->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('homeinstansi');
    }
    public function exportDataInstansi()
    {
            return Excel::download(new InstansiExport, 'data_instansi.xlsx');
    }
}

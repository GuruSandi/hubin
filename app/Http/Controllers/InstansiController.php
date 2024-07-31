<?php

namespace App\Http\Controllers;

use App\Exports\InstansiExport;
use App\Exports\InstansiTemplateExport;
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
    public function intansidelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            Instansi::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function exportDataInstansi()
    {
        return Excel::download(new InstansiExport, 'data_instansi.xlsx');
    }
    public function unduhformatinstansi()
    {
        return Excel::download(new InstansiTemplateExport, 'template_import_instansi.xlsx');
        
    }
}

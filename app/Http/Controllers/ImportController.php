<?php

namespace App\Http\Controllers;

use App\Imports\InstansiImport;
use App\Imports\PembimbingImport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importsiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new SiswaImport, $file);

        return redirect()->back()->with('success', 'Data siswa berhasil diimport.');
    }
    public function importinstansi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new InstansiImport, $file);

        return redirect()->back()->with('success', 'Data instansi berhasil diimport.');
    }
    public function importpembimbing(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PembimbingImport, $file);

        return redirect()->back()->with('success', 'Data pembimbing berhasil diimport.');
    }
}

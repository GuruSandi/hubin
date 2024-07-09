<?php

namespace App\Http\Controllers;

use App\Imports\GuruMapelImport;
use App\Imports\InstansiImport;
use App\Imports\MembimbingImport;
use App\Imports\MenempatiImport;
use App\Imports\PembimbingImport;
use App\Imports\SiswaImport;
use App\Models\membimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        toastr()->success('Data berhasil di Import!');

        return redirect()->back();
    }
    public function importinstansi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new InstansiImport, $file);
        toastr()->success('Data berhasil di Import!');

        return redirect()->back();
    }
    public function importpembimbing(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PembimbingImport, $file);
        toastr()->success('Data berhasil di Import!');
        
        return redirect()->back();
    }
    public function importgurumapel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new GuruMapelImport, $file);
        toastr()->success('Data berhasil di Import!');
        
        return redirect()->back();
    }
    public function importmembimbing(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $userId = Auth::id();

        if ($userId) {
            Excel::import(new MembimbingImport($userId), $request->file('file'));
            toastr()->success('Data berhasil di import!');

            return redirect()->back();
        } else {
            toastr()->error('Pengguna tidak Terautentikasi');

            return redirect()->back();
        }
       
        
        return redirect()->back();
    }
    public function importmenempati(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $userId = Auth::id();

        if ($userId) {
            Excel::import(new MenempatiImport($userId), $request->file('file'));
            toastr()->success('Data berhasil di Import!');
            return redirect()->back();
        } else {
            toastr()->error('Pengguna tidak Terautentikasi');

            return redirect()->back();
        }
       
        
        return redirect()->back();
    }
}

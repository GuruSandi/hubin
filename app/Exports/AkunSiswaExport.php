<?php

namespace App\Exports;

use App\Models\siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AkunSiswaExport implements FromView
{
    public function view(): View
    {
        return view('akunsiswa.exportexcel', [
            'siswaAccounts' => siswa::with('user')->get()
            
        ]);
    }
}

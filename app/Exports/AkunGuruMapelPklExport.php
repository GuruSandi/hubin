<?php

namespace App\Exports;

use App\Models\guru_mapel_pkl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AkunGuruMapelPklExport implements FromView
{
    public function view(): View
    {
        return view('akunGuruMapelPkl.exportexcel', [
            'GuruMapelPklAccounts' => guru_mapel_pkl::with('user')->get()
            
        ]);
    }
}

<?php

namespace App\Exports;

use App\Models\guru_mapel_pkl;
use App\Models\membimbing;
use App\Models\nilai_pkl;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiSiswaExport implements FromView
{
    public function view(): View
    {
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $nilaisiswa = nilai_pkl::where('guru_mapel_pkl_id', $guru_mapel_pkl->id)->with('siswa')->get();
        return view('fiturguru.export.nilai_siswa', [
            'nilaisiswa'  => $nilaisiswa,
            'guru_mapel_pkl'  => $guru_mapel_pkl,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 100,
            'B' => 100, 
            'C' => 100, 
            'D' => 100, 
            'E' => 100, 
            'F' => 100, 
            'G' => 100, 
            'H' => 100, 
            // Tambahkan baris ini untuk setiap kolom yang ingin Anda atur lebarnya
        ];
    }
}

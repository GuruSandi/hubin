<?php

namespace App\Exports;

use App\Models\jurnal;
use App\Models\membimbing;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class JurnalSiswaExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function view(): View
    {
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();
        $menempati = menempati::where('siswa_id', $siswa->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();
        $jurnal = jurnal::whereBetween('tanggal', [$this->startDate, $this->endDate])->where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();
        foreach ($jurnal as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
        }
        return view('jurnal.exportexcel', [
            'jurnal' => $jurnal,
            'menempati' => $menempati,
            'membimbing' => $membimbing,
            'siswa' =>  $siswa,
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate' => $this->endDate->format('d-m-Y')
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

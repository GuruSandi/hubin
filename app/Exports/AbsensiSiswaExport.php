<?php

namespace App\Exports;

use App\Models\absensisiswa;
use App\Models\membimbing;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiSiswaExport implements FromView
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
        $absensisiswa = absensisiswa::whereBetween('tanggal', [$this->startDate, $this->endDate])->where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();
            $counts = [
                'hadir' => 0,
                'alpha' => 0,
                'libur' => 0,
                'tidak_masuk_pkl' => 0
            ];
        foreach ($absensisiswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

            // Format jam_masuk jika ada
            if ($item->jam_masuk) {
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            } else {
                $item->jam_masuk = 'Belum Absen Datang';
            }

            // Format jam_pulang jika ada
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang';
            }
            $keterangan = $item->keterangan;
            if (array_key_exists($keterangan, $counts)) {
                $counts[$keterangan]++;
            } else {
                $counts[$keterangan] = 1; // Jika ada keterangan yang tidak dikenali, tambahkan ke hitungan
            }
             // Set keterangan untuk tampilan
             $item->keterangan = match ($item->keterangan) {
                'hadir' => 'Hadir',
                'alpha' => 'Alpha',
                'libur' => 'Libur',
                'tidak_masuk_pkl' => 'Tidak Masuk PKL',
                default => 'Tidak Diketahui',
            };
        }
        return view('absensi.exportexcel', [
            'absensisiswa' => $absensisiswa,
            'menempati' => $menempati,
            'membimbing' => $membimbing,
            'siswa' =>  $siswa,
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate' => $this->endDate->format('d-m-Y'),
            'counts' => $counts,
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

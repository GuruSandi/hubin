<?php

namespace App\Console\Commands;

use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class absensisiswa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hasilkan absensi harian untuk semua siswa dan perbarui status absen jika tidak ditandai';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggal = Carbon::today()->format('Y-m-d');
        $siswas = siswa::all();

        foreach ($siswas as $siswa) {
            $absensi = AbsensiSiswa::where('siswa_id', $siswa->id)
                ->where('tanggal', $tanggal)
                ->first();

            if ($absensi) {
                // Jika entri absensi sudah ada, cek apakah keterangan sudah diupdate
                if (is_null($absensi->jam_masuk) && is_null($absensi->jam_pulang)) {
                    // Jika belum melakukan absensi, update keterangan menjadi 'absen'
                    $absensi->update([
                        'keterangan' => 'absen',
                    ]);
                }
            } else {
                // Jika tidak ada entri sama sekali, buat entri dengan keterangan 'absen'
                absensisiswa::create([
                    'user_id' => $siswa->user_id,
                    'siswa_id' => $siswa->id,
                    'tanggal' => $tanggal,
                    'latitude' => null,
                    'longitude' => null,
                    'jarak' => null,
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'keterangan' => 'absen',
                ]);
            }
        }
    
    }
}

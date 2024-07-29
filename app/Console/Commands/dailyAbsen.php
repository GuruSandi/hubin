<?php

namespace App\Console\Commands;

use App\Models\absensisiswa;
use App\Models\menempati;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class dailyAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absensi:harian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'absensi otomatis absen';

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
        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {
            // Cek apakah siswa sudah ditempatkan di instansi
            $menempati = menempati::where('siswa_id', $siswa->id)->first();

            if ($menempati) {
                // Jika siswa sudah ditempatkan di instansi
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
                    AbsensiSiswa::create([
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
}

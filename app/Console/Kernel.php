<?php

namespace App\Console;

use App\Models\absensisiswa;
use App\Models\siswa;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    //    "\App\Console\Commands\DbBackup",
    //    "\App\Console\Commands\ClearOldBackups"
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('backup:clear')->daily();
        // $schedule->command('db:backup')->daily();
       
        $schedule->call(function () {
            // Periksa absensi siswa pada hari itu
            $absensi = absensisiswa::whereDate('created_at', today())->get();

            // Ambil semua siswa
            $siswaIds = siswa::pluck('user_id');

            // Loop melalui setiap siswa
            foreach ($siswaIds as $userId) {
                // Periksa apakah siswa telah melakukan absensi pada hari itu
                $absensiSiswa = $absensi->where('user_id', $userId)->first();

                // Jika tidak ada entri absensi untuk siswa pada hari itu, ubah keterangan absensi menjadi "tidak hadir"
                if (!$absensiSiswa) {
                    absensisiswa::create([
                        'user_id' => $userId,
                        'latitude' => 0, // Atau nilai default lainnya
                        'longitude' => 0, // Atau nilai default lainnya
                        'keterangan' => 'absen'
                    ]);
                }
            }
        })->daily(); // Jalankan skrip ini setiap hari
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    
    
}

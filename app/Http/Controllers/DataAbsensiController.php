<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAbsensiController extends Controller
{
    public function dataabsensisiswaperhari()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $absensisiswa = DB::table('membimbings')
            ->select('membimbings.*', 'guru_mapel_pkls.nama as nama_gurumapel', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.latitude', 'absensisiswas.longitude', 'absensisiswas.created_at', 'absensisiswas.keterangan', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.id',  'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->whereDate('absensisiswas.tanggal', Carbon::now()->toDateString())
            ->orderBy('absensisiswas.created_at', 'desc')
            ->get();
            foreach ($absensisiswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');;
    
                // Format jam_masuk jika ada
                if ($item->jam_masuk) {
                    $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H:i');
                } else {
                    $item->jam_masuk = 'Belum Absen Datang';
                }
    
                // Format jam_pulang jika ada
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H:i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang';
                }
            }
        return view('dataabsensisiswa.homedataabsensisiswaperhari', compact('absensisiswa'));
    }
    public function posteditdataabsensisiswaperhari(Request $request, absensisiswa $absensisiswa)
    {
       $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
            'jarak' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
        ]);
        $absensisiswa->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('dataabsensisiswaperhari');

    }
    public function hapusdataabsensisiswaperhari(absensisiswa $absensisiswa)
    {
        $absensisiswa->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('dataabsensisiswaperhari');

    }
    public function dataabsensisiswa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $absensisiswa = DB::table('membimbings')
            ->select('membimbings.*', 'guru_mapel_pkls.nama as nama_gurumapel', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.latitude', 'absensisiswas.longitude', 'absensisiswas.created_at', 'absensisiswas.keterangan', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.id',  'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->orderBy('absensisiswas.created_at', 'desc')
            ->paginate(100);

            // ->get();
            foreach ($absensisiswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');;
    
                // Format jam_masuk jika ada
                if ($item->jam_masuk) {
                    $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H:i');
                } else {
                    $item->jam_masuk = 'Belum Absen Datang';
                }
    
                // Format jam_pulang jika ada
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H:i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang';
                }
            }
        return view('dataabsensisiswa.homedataabsensi', compact('absensisiswa'));
    }
    public function searchdataabsensisiswa(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $query = DB::table('membimbings')
            ->select('membimbings.*', 'guru_mapel_pkls.nama as nama_gurumapel', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.latitude', 'absensisiswas.longitude', 'absensisiswas.created_at', 'absensisiswas.keterangan', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.id',  'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id');
            

            // ->get();
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('siswas.nama', 'like', "%{$search}%")
                        ->orWhere('guru_mapel_pkls.nama', 'like', "%{$search}%");
                });
            }
    
            if ($startDate && $endDate) {
                $query->whereBetween('absensisiswas.tanggal', [$startDate, $endDate]);
            }
    
            $absensisiswa = $query->orderBy('absensisiswas.created_at', 'desc')
            ->paginate(100)
            ->appends($request->except('page'));

            foreach ($absensisiswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');;
    
                // Format jam_masuk jika ada
                if ($item->jam_masuk) {
                    $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H:i');
                } else {
                    $item->jam_masuk = 'Belum Absen Datang';
                }
    
                // Format jam_pulang jika ada
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H:i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang';
                }
            }
        return view('dataabsensisiswa.searchdataabsensisiswa', compact('absensisiswa'));
    }
    public function posteditdataabsensisiswa(Request $request, absensisiswa $absensisiswa)
    {
       $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
            'jarak' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
        ]);
        $absensisiswa->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('dataabsensisiswa');

    }
    public function hapusdataabsensisiswa(absensisiswa $absensisiswa)
    {
        $absensisiswa->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('dataabsensisiswa');

    }
    public function dataabsensidelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            absensisiswa::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataJurnalController extends Controller
{
    public function datajurnalsiswa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');

        $datajurnal = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal', 'jurnals.tanggal',  'jurnals.id', 'jurnals.validasi', 'pembimbings.nama as nama_pembimbing', 'guru_mapel_pkls.nama as nama_gurumapel')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id',)
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->orderBy('jurnals.created_at', 'desc')
            ->get();
        foreach ($datajurnal as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');;
        }
        return view('datajurnalsiswa.homedatajurnal', compact('datajurnal'));
    }
    public function datajurnalbelumdivalidasi()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');

        $datajurnal = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal', 'jurnals.tanggal',  'jurnals.id', 'jurnals.validasi', 'pembimbings.nama as nama_pembimbing', 'guru_mapel_pkls.nama as nama_gurumapel')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id',)
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->where('jurnals.validasi', 'belum_tervalidasi')
            ->orderBy('jurnals.created_at', 'desc')
            ->get();
        foreach ($datajurnal as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');;
        }
        return view('datajurnalsiswa.datajurnalbelumvalidasi', compact('datajurnal'));
    }
    public function jurnalvalidasisiswa(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['success' => false], 400);
        }

        try {
            // Update status to 'tervalidasi'
            jurnal::whereIn('id', $ids)->update(['validasi' => 'tervalidasi']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function posteditdatajurnalsiswa(Request $request, jurnal $jurnal)
    {
        $data = $request->validate([
            'deskripsi_jurnal' => 'required',
            'tanggal' => 'required|date',
            'validasi' => 'required',
        ]);
        $jurnal->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('datajurnalsiswa');
    }
    public function hapusdatajurnalsiswa(jurnal $jurnal)
    {
        $jurnal->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('datajurnalsiswa');
    }
    public function datajurnaldelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            jurnal::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

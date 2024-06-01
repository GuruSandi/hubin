<?php

namespace App\Http\Controllers;

use App\Models\instansi;
use App\Models\membimbing;
use App\Models\pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembimbingController extends Controller
{
    public function homemembimbing()
    {
        $membimbing = membimbing::all();
       
        $membimbing_sorted = $membimbing->sortBy('pembimbing');
        return view('membimbing.homemembimbing', compact('membimbing_sorted'));
    }
    public function tambahmembimbing()
    {
        $pembimbing=pembimbing::all();
        $instansi=instansi::all();
        $instansi_terpilih = membimbing::pluck('instansi_id')->toArray();
        $instansi_tersedia = $instansi->whereNotIn('id', $instansi_terpilih);
        return view('membimbing.tambahmembimbing', compact('instansi_tersedia','pembimbing'));
    }
    public function posttambahmembimbing(Request $request)
    {
        $request->validate([
            'instansi_ids' => 'required|array',
            'pembimbing_id' => 'required|exists:pembimbings,id',
        ]);
        foreach ($request->instansi_ids as $instansiId) {
            membimbing::create([
                'instansi_id' => $instansiId,
                'pembimbing_id' => $request->pembimbing_id,
                'user_id' => Auth::id(),
            ]);
        }
        
        return redirect()->route('homemembimbing')->with('status', 'Berhasil Menambah data');
    }
    public function editmembimbing(membimbing $membimbing)
    {
        $pembimbing = pembimbing::all();
        $instansi = instansi::all();
        $selectinstansi = $membimbing->instansi_id;
        $selectpembimbing = $membimbing->pembimbing_id;
        return view('membimbing.editmembimbingsatu', compact('membimbing','pembimbing','instansi','selectinstansi','selectpembimbing'));
    }
   
   
    public function posteditmembimbing(Request $request, membimbing $membimbing)
    {
        $data=$request->validate([
            'pembimbing_id' => 'required',
            'instansi_id' => 'required',
        ]);
        $membimbing->update($data);

        return redirect()->route('homemembimbing')->with('status', 'Berhasil Mengedit data');
    }
    public function hapusmembimbing(membimbing $membimbing)
    {
        $membimbing->delete();
      
        return redirect()->route('homemembimbing')->with('status', 'Berhasil Menghapus data');
    }
}

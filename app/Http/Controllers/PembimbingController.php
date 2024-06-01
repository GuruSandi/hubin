<?php

namespace App\Http\Controllers;

use App\Models\pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function homepembimbing()
    {
        $pembimbing = pembimbing::all();
        return view('pembimbing.homepembimbing', compact('pembimbing'));
    }
    public function tambahpembimbing()
    {
        return view('pembimbing.tambahpembimbing');
    }
    public function posttambahpembimbing(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        pembimbing::create([
            'nama' => $request->nama,
        ]);
        
        return redirect()->route('homepembimbing')->with('status', 'Berhasil Menambah data');
    }
    public function editpembimbing(pembimbing $pembimbing)
    {
        return view('pembimbing.editpembimbing', compact('pembimbing'));
    }
    public function posteditpembimbing(Request $request, pembimbing $pembimbing)
    {
        $data =  $request->validate([
            'nama' => 'required',
        ]);
       
        $pembimbing->update($data);
        
        return redirect()->route('homepembimbing')->with('status', 'Berhasil Mengedit data');
    }
    public function hapuspembimbing(pembimbing $pembimbing)
    {
        $pembimbing->delete();
      
        return redirect()->route('homepembimbing')->with('status', 'Berhasil Menghapus data');
    }
}

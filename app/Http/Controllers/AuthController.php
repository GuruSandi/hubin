<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function homeakunsiswa()
    {
        $siswaAccounts = siswa::with('user')->get();
        
        return view('akunsiswa.homeakunsiswa', compact('siswaAccounts'));
    }
    public function tambahakunsiswa()
    {
       
        return view('akunsiswa.tambahakunsiswa');
    }
    public function posttambahakunsiswa(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        User::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'role'=>'siswa',
        ]);

        return redirect()->route('homeakunsiswa')->with('status','berhasil menambahkan akun siswa');
    }
    public function editakunsiswa(Request $request, User $user)
    {
        
        return view('akunsiswa.editakunsiswa', compact('user'));
    }
    public function posteditakunsiswa(Request $request, User $user)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $user->update([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
        ]);

        return redirect()->route('homeakunsiswa')->with('status','berhasil mengubah data akun siswa');
    }
    public function hapusakunsiswa(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('homeakunsiswa')->with('status','berhasil menghapus akun siswa');
    }
    public function login()
    {

        return view('auth.login');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('status','Berhasil Logout');
    }
    public function postlogin(Request $request)
    {

        $cek=$request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        if (Auth::attempt($cek)) {
            $user=Auth::user();
            if ($user->role == 'admin') {
               
                return redirect()->route('homesiswa')->with('status','Welcome ' .$user->username);
            } elseif ($user->role == 'guru') {
               
                return redirect()->route('home')->with('status','Welcome ' .$user->username);

            } elseif ($user->role == 'siswa') {
                return redirect()->route('dashboardsiswa')->with('status','Welcome ' .$user->username);

            }

        }

        return back()->with('status','Username atau Password salah');
    }

   
}

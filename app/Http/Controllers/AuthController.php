<?php

namespace App\Http\Controllers;

use App\Exports\AkunAdminExport;
use App\Exports\AkunGuruMapelPklExport;
use App\Exports\AkunSiswaExport;
use App\Models\guru_mapel_pkl;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AuthController extends Controller
{
    public function homeakunsiswa()
    {
        $siswaAccounts = siswa::with('user')->get();
        
        return view('akunsiswa.homeakunsiswa', compact('siswaAccounts'));
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
            'encrypted_password' => $request->password,
            
        ]);
        toastr()->success('Data berhasil di update!');

        return redirect()->route('homeakunsiswa');
    }
    public function hapusakunsiswa(User $user)
    {
        $user->delete();
        toastr()->success('Data berhasil dihapus');

        return redirect()->route('homeakunsiswa');
    }
    public function login()
    {
        
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
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
            $request->session()->regenerate();
            if ($user->role == 'admin') {    
                return redirect()->route('DashboardAdmin')->with('status','Welcome ' .$user->username);
            } elseif ($user->role == 'guru') {
                return redirect()->route('dashboardguru')->with('status','Welcome ' .$user->username);
            } elseif ($user->role == 'siswa') {
                return redirect()->route('dashboardsiswa')->with('status','Welcome ' .$user->username);
            }
        }
        return back()->with('status','Username atau Password salah');
    }
    public function unduhAkunsiswa()
    {
        return Excel::download(new AkunSiswaExport, 'data_Akun_siswa.xlsx');
       
    }

    public function homeGuruMapelPkl()
    {
        $GuruMapelPklAccounts = guru_mapel_pkl::with('user')->get();
        
        return view('akunGuruMapelPkl.homeakungurumapelpkl', compact('GuruMapelPklAccounts'));
    }
    
    
    public function posteditakunGuruMapelPkl(Request $request, User $user)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $user->update([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'encrypted_password' => $request->password,
            
        ]);
        toastr()->success('Data berhasil di update!');
        return redirect()->route('homeakunGuruMapelPkl');
    }
    public function hapusakunGuruMapelPkl(User $user)
    {
        $user->delete();
        toastr()->success('Data berhasil dihapus');

        return redirect()->route('homeakunGuruMapelPkl');
    }
    public function unduhGuruMapelPkl()
    {
        return Excel::download(new AkunGuruMapelPklExport, 'data_Akun_GuruMapelPkl.xlsx');
       
    }
    public function homeakunadmin()
    {
        $adminAccounts = User::where('role','admin')->get();
        
        return view('akunadmin.homeakunadmin', compact('adminAccounts'));
    }
    
    public function posttambahakunadmin(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        User::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'encrypted_password' => $request->password,
            'role'=>'admin',
        ]);
        toastr()->success('Data berhasil ditambahkan!');

        return redirect()->route('homeakunadmin');
    }
    
    public function posteditakunadmin(Request $request, User $user)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $user->update([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'encrypted_password' => $request->password,
            
        ]);
        toastr()->success('Data berhasil di update!');

        return redirect()->route('homeakunadmin');
    }
    public function hapusakunadmin(Request $request, User $user)
    {
        $user->delete();
        return redirect()->route('homeakunadmin');
    }
    public function unduhakunadmin()
    {
        return Excel::download(new AkunAdminExport, 'data_Akun_Admin.xlsx');
       
    }
}

<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AkunAdminExport implements FromView
{
    public function view(): View
    {
        return view('akunGuruMapelPkl.exportexcel', [
            'AdminAccounts' => User::where('role','admin')->get()
            
        ]);
    }
}

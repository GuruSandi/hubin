<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Periksa apakah pengguna memiliki salah satu role yang diizinkan
            foreach ($roles as $role) {
                if (Auth::user()->role == $role) {
                    return $next($request);
                }
            }
        }
        toastr()->error('Anda tidak memiliki izin untuk mengakses halaman ini.');

        // Jika tidak memiliki role yang diizinkan, kembalikan ke halaman sebelumnya atau halaman default
        return redirect()->back();
    }
}

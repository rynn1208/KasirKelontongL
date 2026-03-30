<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Titik tiga (...) artinya middleware ini bisa menerima lebih dari 1 role sekaligus
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login DAN apakah role-nya sesuai
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Jika tidak punya akses, tendang kembali ke Dashboard
            return redirect('/dashboard')->with('error', 'Akses Ditolak! Anda tidak memiliki izin untuk halaman tersebut.');
        }

        // Jika aman, silakan lewat
        return $next($request);
    }
}
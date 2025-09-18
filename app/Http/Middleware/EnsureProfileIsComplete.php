<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Cek jika pengguna sudah login, profilnya belum lengkap,
        // DAN dia tidak sedang mencoba mengakses halaman untuk melengkapi profil (mencegah redirect loop)
        if ($user && is_null($user->datadiri_id) && !$request->routeIs('filament.admin.pages.lengkapi-data-diri')) {
            // Beri notifikasi
            session()->flash('filament.notifications', [
                [
                    'id' => 'profile-incomplete',
                    'title' => 'Profil Belum Lengkap!',
                    'body' => 'Silakan lengkapi data diri Anda untuk melanjutkan.',
                    'status' => 'warning',
                    'duration' => 'persistent',
                ],
            ]);
            
            // Redirect paksa ke halaman pengisian data diri
            return redirect()->route('filament.admin.pages.lengkapi-data-diri');
        }

        return $next($request);
    }
}

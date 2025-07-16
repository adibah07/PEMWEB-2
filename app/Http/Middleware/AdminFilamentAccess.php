<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminFilamentAccess
{    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
          // Debug log
        Log::info('AdminFilamentAccess middleware', [
            'user_id' => $user?->id,
            'user_role' => $user?->role,
            'is_admin' => $user?->role === 'admin',
            'request_path' => $request->path()
        ]);
        
        // Jika user tidak login atau bukan admin
        if (!$user || $user->role !== 'admin') {
            // Logout user dari filament
            Auth::logout();
            
            return redirect('/login')->with('error', 'Akses dashboard Filament hanya untuk Admin.');
        }
        
        return $next($request);
    }
}

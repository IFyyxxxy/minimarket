<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CekRole {
    public function handle(Request $request, Closure $next, $role) {
        // Mengecek apakah role user tidak sama dengan parameter role di route
        if ($request->user() && $request->user()->role !== $role) {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }
        return $next($request);
    }
}
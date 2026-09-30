<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin {
    public function handle(Request $request, Closure $next){
        if (Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return abort(403, 'Akses ditolak, silakan login terlebih dahulu.');
        }
    }
    public function terminate(Request $request, $response)
{
    \Illuminate\Support\Facades\Log::info('Request selesai', ['url' => $request->fullUrl()]);
}
}
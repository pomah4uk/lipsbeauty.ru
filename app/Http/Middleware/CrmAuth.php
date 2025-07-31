<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrmAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('crm_auth')) {
            return redirect()->route('crm.login');
        }
        return $next($request);
    }
} 
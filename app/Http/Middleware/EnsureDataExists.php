<?php
// app/Http/Middleware/EnsureDataExists.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureDataExists
{
    public function handle(Request $request, Closure $next)
    {
        $data = $request->input('data') ?? [];
        $request->merge(['data' => $data]);

        return $next($request);
    }
}

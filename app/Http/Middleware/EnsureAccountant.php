<?php

namespace App\Http\Middleware;

use App\Services\AccountantContextService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountant
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->guest(route('showlogin'));
        }

        if (Auth::user()->roles !== 'accountant') {
            abort(403, 'This area is for accountants only.');
        }

        $this->accountantContext->syncSchoolSession(Auth::user());

        return $next($request);
    }
}

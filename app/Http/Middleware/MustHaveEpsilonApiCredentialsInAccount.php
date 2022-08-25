<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustHaveEpsilonApiCredentialsInAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->auth()->user();
        if(!$user)  return redirect()->route('login');
        if(!$user->epsilon_client_id || !$user->epsilon_client_secret)  return redirect()->route('credentials.epsilon');

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = auth()->user()->id;

        $checkIsAdmin = User::with('roles')->findOrFail($userId);

        $userRoles = $checkIsAdmin->roles()->pluck('title');

        //  if 'ROLE_ADMIN' exists in the user's roles
        $isAdmin = $userRoles->contains(Role::ROLE_ADMIN);



        if (auth()->check() && $isAdmin) {
            return $next($request);
        }

        // dd(auth()->user());

        // Redirect or handle unauthorized access (e.g., show an error page)
        return response([
            'message' => 'Доступ запрещен'
        ]);;
    }
}

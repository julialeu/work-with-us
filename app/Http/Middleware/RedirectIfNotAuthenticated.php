<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Exception\UserUnauthenticatedException;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;

class RedirectIfNotAuthenticated
{
    public function __construct(
        private GetAuthenticatedUserService $getAuthenticatedUserService
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string|null ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        try {
            $authenticatedUser = $this->getAuthenticatedUserService->execute();
        } catch (UserUnauthenticatedException $e) {
            return redirect()->route('pleaseLogin');
        }

        if ($authenticatedUser === null) {
            return redirect()->route('pleaseLogin');
        }

        return $next($request);
    }
}

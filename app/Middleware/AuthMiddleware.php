<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Middleware;

use Lowel\Workproject\App\Services\Auth;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AuthMiddleware implements IMiddleware
{
    /**
     * Start auth session
     * @param Request $request
     * @return void
     */
    public function handle(Request $request): void
    {
        Auth::start();
    }

}
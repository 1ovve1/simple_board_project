<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class OnlyAuthMiddleware implements IMiddleware
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        if (is_auth() === false) {
            redirect(route('index'));
        }
    }

}
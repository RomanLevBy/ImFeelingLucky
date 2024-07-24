<?php

namespace App\Http\Middleware\Web;

use App\Services\Link\LinkService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ValidateLinkHash
{
    /**
     * ValidateLinkHash constructor
     *
     * @param LinkService $linkService
     */
    public function __construct(
        private LinkService $linkService
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->has('link_hash')) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        try {
            $this->linkService->get($request->get('link_hash'));
        } catch (\Exception) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        return $next($request);
    }
}

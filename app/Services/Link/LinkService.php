<?php

namespace App\Services\Link;

use App\Models\Link;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LinkService
{
    /**
     * LinkService constructor
     *
     * @param HashService $hashService
     */
    public function __construct(
        private HashService $hashService
    ) {}

    /**
     * @param string $hash
     * @return Link
     */
    public function get(string $hash): Link
    {
        $link = Link::query()
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->where('hash', $hash)
            ->first();

        if (!$link) {
            throw new NotFoundHttpException();
        }

        return $link;
    }

    /**
     * @return Link
     */
    public function getLinkInstance(): Link
    {
        $link = new Link();
        $link->hash = $this->hashService->getHash();

        return $link;
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function delete(string $hash): bool
    {
        Link::where('hash', $hash)->delete();

        return true;
    }
}

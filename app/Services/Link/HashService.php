<?php

namespace App\Services\Link;

class HashService
{
    const HASH_CONSTRAIN = '[0-9a-f]+';

    /**
     * @return string
     */
    public function getHash(): string
    {
        return uniqid();
    }
}

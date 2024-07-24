<?php

namespace App\Services\Game;

class Randomizer
{
    /**
     * @return int
     */
    public function get(): int
    {
        return rand(0, 1000);
    }
}

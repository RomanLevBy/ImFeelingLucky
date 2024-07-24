<?php

namespace App\Services\Game;

use App\Enums\Game\GameResult;

class ProfitService
{
    const RESULT_PRECISION = 2;

    /**
     * @param int $score
     * @return float
     */
    public function getWinAmount(int $score): float
    {
        $percent = match (true) {
            $score > 900 => 0.7,
            $score > 600 => 0.5,
            $score > 300 => 0.3,
            default => 0.1,
        };

        return $this->toPrecision($score * $percent);
    }

    /**
     * @param int $score
     * @return GameResult
     */
    public function getResult(int $score): GameResult
    {
        return $score % 2 === 0 ? GameResult::Win : GameResult::Lose;
    }

    /**
     * Round amount of amount to second precision
     *
     * @param float $amount
     * @return float
     */
    private function toPrecision(float $amount): float
    {
        return round($amount, self::RESULT_PRECISION, PHP_ROUND_HALF_DOWN);
    }
}

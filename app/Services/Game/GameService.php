<?php

namespace App\Services\Game;

use App\Enums\Game\GameResult;
use App\Enums\Game\GameSource;
use App\Models\Game;

readonly class GameService
{
    /**
     * @param Randomizer $randomizer
     * @param ProfitService $profitService
     */
    public function __construct(
        private Randomizer    $randomizer,
        private ProfitService $profitService,
    ) {}

    /**
     * @return Game
     */
    public function getGameInstance(): Game
    {
        $score = $this->randomizer->get();
        $result = $this->profitService->getResult($score);

        $winAmount = 0;
        if ($result === GameResult::Win) {
            $winAmount =  $this->profitService->getWinAmount($score);
        }

        $game = new Game();
        $game->source = GameSource::Web;
        $game->score = $score;
        $game->result = $result;
        $game->win_amount = $winAmount;

        return $game;
    }
}

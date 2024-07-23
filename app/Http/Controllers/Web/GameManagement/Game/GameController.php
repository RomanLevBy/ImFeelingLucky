<?php

namespace App\Http\Controllers\Web\GameManagement\Game;

use App\DataTransferObjects\GamesCursorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GamesRequest;
use App\Services\Game\GameService;
use App\Services\Link\LinkService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * @param GameService $gameService
     * @param LinkService $linkService
     */
    public function __construct(
        private readonly GameService $gameService,
        private readonly LinkService $linkService
    )
    {
    }

    /**
     * @param GamesRequest $request
     * @return View
     */
    public function index(GamesRequest $request): View
    {
        $gamesCursorDto = GamesCursorDto::fromWebRequest($request);
        $currentLink = $this->linkService->get($request->get('link_hash'));

        $games = $currentLink->games()
            ->orderBy('id', 'DESC')
            ->limit($gamesCursorDto->limit)
            ->get();

        return view('web.game.index', ['games' => $games, 'link' => $currentLink]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request): Application|Factory|View
    {
        $currentLink = $this->linkService->get($request->get('link_hash'));

        $game = $this->gameService->getGameInstance();
        $currentLink->games()->save($game);

        return view('web.link.show', ['link' => $currentLink, 'game' => $game]);
    }
}

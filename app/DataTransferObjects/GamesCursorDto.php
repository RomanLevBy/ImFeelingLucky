<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Web\GamesRequest;

readonly class GamesCursorDto
{
    const DEFAULT_LIMIT = 3;

    /**
     * GamesCursorDto construct
     *
     * @param int $limit
     */
    public function __construct(
        public int $limit,
    )
    {
    }

    /**
     * Retrieve UserDto from Wev request
     *
     * @param GamesRequest $request
     * @return self
     */
    public static function fromWebRequest(GamesRequest $request): self
    {
        return new GamesCursorDto(
            limit: $request->validated('limit', static::DEFAULT_LIMIT),
        );
    }
}

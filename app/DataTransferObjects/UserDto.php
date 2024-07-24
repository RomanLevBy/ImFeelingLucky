<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Web\UserRequest;

readonly class UserDto
{
    /**
     * UserDto construct
     *
     * @param string $username
     * @param int $phone
     */
    public function __construct(
        public string $username,
        public int    $phone,
    )
    {
    }

    /**
     * Retrieve UserDto from Wev request
     *
     * @param UserRequest $request
     * @return self
     */
    public static function fromWebRequest(UserRequest $request): self
    {
        return new UserDto(
            username: $request->validated('username'),
            phone: $request->validated('phone'),
        );
    }
}

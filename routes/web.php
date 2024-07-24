<?php

use App\Http\Controllers\Web\GameManagement\Game\GameController;
use App\Http\Controllers\Web\GameManagement\Link\LinkController;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Middleware\Web\ValidateLinkHash;
use App\Services\Link\HashService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.register');
});

Route::post('/users', [UserController::class, 'store'])
    ->name('user.create');

Route::prefix('/game-management')->group(function () {
    Route::get('/links/{hash}/preview', [LinkController::class, 'preview'])
        ->where(['hash' => HashService::HASH_CONSTRAIN])
        ->name('link.preview');

    Route::get('/links/{hash}', [LinkController::class, 'show'])
        ->where(['hash' => HashService::HASH_CONSTRAIN])
        ->name('link.show');

    Route::middleware([ValidateLinkHash::class])->group(function () {
        Route::post('/links', [LinkController::class, 'store'])
            ->name('link.store');

        Route::delete('/links/{hash}', [LinkController::class, 'delete'])
            ->where(['hash' => HashService::HASH_CONSTRAIN])
            ->name('link.delete');

        Route::post('/games', [GameController::class, 'store'])
            ->name('game.store');
    });

    Route::get('/games', [GameController::class, 'index'])
        ->name('game.index');
});



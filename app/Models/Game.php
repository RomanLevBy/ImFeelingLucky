<?php

namespace App\Models;

use App\Enums\Game\GameSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $casts = [
        'source' => GameSource::class
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}

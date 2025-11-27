<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Followers
 *
 * @property int $id
 * @property int $following
 * @property int $followers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Followers newModelQuery()
 * @method static Builder|Followers newQuery()
 * @method static Builder|Followers query()
 * @method static Builder|Followers whereCreatedAt($value)
 * @method static Builder|Followers whereFollowers($value)
 * @method static Builder|Followers whereFollowing($value)
 * @method static Builder|Followers whereId($value)
 * @method static Builder|Followers whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Followers extends Model
{
    use HasFactory;

    protected $fillable = [
        'following',
        'followers',
    ];

    public function follow(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following');
    }

    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followers');
    }
}

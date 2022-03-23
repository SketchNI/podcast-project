<?php

namespace App\Models;

use Database\Factories\EpisodeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\Episode
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $status
 * @property string|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static EpisodeFactory factory(...$parameters)
 * @method static Builder|Episode newModelQuery()
 * @method static Builder|Episode newQuery()
 * @method static Builder|Episode query()
 * @method static Builder|Episode whereCreatedAt($value)
 * @method static Builder|Episode whereDescription($value)
 * @method static Builder|Episode whereId($value)
 * @method static Builder|Episode wherePublishedAt($value)
 * @method static Builder|Episode whereSlug($value)
 * @method static Builder|Episode whereStatus($value)
 * @method static Builder|Episode whereTitle($value)
 * @method static Builder|Episode whereUpdatedAt($value)
 * @method static Builder|Episode whereUuid($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class Episode extends Model
{
    use HasFactory;

    public $timestamps = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'users'
    ];

    /**
     * Retrieve all cast members.
     *
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Cast::class);
    }
}

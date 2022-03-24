<?php

namespace App\Models;

use Database\Factories\CastFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cast
 *
 * @method static CastFactory factory(...$parameters)
 * @method static Builder|Cast newModelQuery()
 * @method static Builder|Cast newQuery()
 * @method static Builder|Cast query()
 * @method static Builder|Cast whereEpisodeId($value)
 * @method static Builder|Cast whereUserId($value)
 * @property int $user_id
 * @property int $episode_id
 * @mixin Eloquent
 *
 */
class Cast extends Model
{
    use HasFactory;
}

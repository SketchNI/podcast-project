<?php

namespace App\Models;

use App\Casts\Crypt;
use Database\Factories\ProfileFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $bio
 * @property string|null $twitter
 * @property string|null $goodreads
 * @property string|null $discord
 * @property-read User|null $user
 * @method static ProfileFactory factory(...$parameters)
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @method static Builder|Profile whereBio($value)
 * @method static Builder|Profile whereDiscord($value)
 * @method static Builder|Profile whereGoodreads($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile whereTwitter($value)
 * @method static Builder|Profile whereUserId($value)
 * @mixin Eloquent
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * Disable timestamps on this modal.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'bio',
        'twitter',
        'goodreads',
        'discord'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'bio' => Crypt::class,
        'twitter' => Crypt::class,
        'discord' => Crypt::class,
        'goodreads' => Crypt::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string|null
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * @param string|null $bio
     * @return Profile
     */
    public function setBio(?string $bio): Profile
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @param string|null $twitter
     * @return Profile
     */
    public function setTwitter(?string $twitter): Profile
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGoodreads(): ?string
    {
        return $this->goodreads;
    }

    /**
     * @param string|null $goodreads
     * @return Profile
     */
    public function setGoodreads(?string $goodreads): Profile
    {
        $this->goodreads = $goodreads;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscord(): ?string
    {
        return $this->discord;
    }

    /**
     * @param string|null $discord
     * @return Profile
     */
    public function setDiscord(?string $discord): Profile
    {
        $this->discord = $discord;
        return $this;
    }
}

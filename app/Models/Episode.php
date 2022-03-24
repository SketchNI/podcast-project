<?php

namespace App\Models;

use App\Casts\Crypt;
use App\Casts\Json;
use Database\Factories\EpisodeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Episode
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $media_path
 * @property string $metadata
 * @property string $status
 * @property string|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static EpisodeFactory factory(...$parameters)
 * @method static Builder|Episode newModelQuery()
 * @method static Builder|Episode newQuery()
 * @method static Builder|Episode query()
 * @method static Builder|Episode whereCreatedAt($value)
 * @method static Builder|Episode whereDescription($value)
 * @method static Builder|Episode whereId($value)
 * @method static Builder|Episode whereMediaPath($value)
 * @method static Builder|Episode whereMetadata($value)
 * @method static Builder|Episode wherePublishedAt($value)
 * @method static Builder|Episode whereSlug($value)
 * @method static Builder|Episode whereStatus($value)
 * @method static Builder|Episode whereTitle($value)
 * @method static Builder|Episode whereUpdatedAt($value)
 * @method static Builder|Episode whereUuid($value)
 * @mixin Eloquent
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

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Episode
     */
    public function setUuid(): Episode
    {
        $this->uuid = Uuid::uuid4();
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Episode
     */
    public function setTitle(string $title): Episode
    {
        $this->title = $title;
        $this->setSlug($title);
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Episode
     */
    public function setSlug(string $slug): Episode
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Episode
     */
    public function setDescription(string $description): Episode
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Episode
     */
    public function setStatus(string $status): Episode
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublishedAt(): ?string
    {
        return $this->published_at;
    }

    /**
     * @param string|null $published_at
     * @return Episode
     */
    public function setPublishedAt(?string $published_at): Episode
    {
        $this->published_at = $published_at;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getMediaPath(): string
    {
        return $this->media_path;
    }

    /**
     * @param string $media_path
     * @return Episode
     */
    public function setMediaPath(string $media_path): Episode
    {
        $this->media_path = $media_path;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetadata(): string
    {
        return $this->metadata;
    }

    /**
     * @param string $metadata
     * @return Episode
     */
    public function setMetadata(string $metadata): Episode
    {
        $this->metadata = $metadata;
        return $this;
    }
}

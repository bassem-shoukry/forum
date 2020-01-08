<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Filters\ThreadFilters;
/**
 * App\Thread
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Thread newModelQuery()
 * @method static Builder|Thread newQuery()
 * @method static Builder|Thread query()
 * @method static Builder|Thread whereBody($value)
 * @method static Builder|Thread whereCreatedAt($value)
 * @method static Builder|Thread whereId($value)
 * @method static Builder|Thread whereTitle($value)
 * @method static Builder|Thread whereUpdatedAt($value)
 * @method static Builder|Thread whereUserId($value)
 * @mixin Eloquent
 * @property int $channel_id
 * @property-read Channel $channel
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|Reply[] $replies
 * @property-read int|null $replies_count
 * @method static Builder|Thread filter($filters)
 * @method static Builder|Thread whereChannelId($value)
 */
class Thread extends Model
{
    protected $guarded =[];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @param $query
     * @param ThreadFilters $filters
     * @return mixed
     */
    public function scopeFilter($query,$filters)
    {
        return $filters->apply($query);
    }
}

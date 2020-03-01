<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Traits\Favoritable;
/**
 * App\Reply
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\\Models\Reply whereUserId($value)
 * @mixin Eloquent
 * @property-read User $owner
 */
class Reply extends Model
{
    use Favoritable;

    protected $guarded = [];

    protected $with = ['owner','favorites'];

    protected $withCount = ['favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

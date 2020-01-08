<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Channel
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thread[] $threads
 * @property-read int|null $threads_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Channel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Channel extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

}

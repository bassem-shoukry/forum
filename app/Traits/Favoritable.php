<?php


namespace App\Traits;


use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Trait_;

Trait Favoritable
{
    /**
     * A reply can be favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }


    /**
     * Favorite the current reply.
     *
     * @return Model
     */
    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }


    public function is_favorited()
    {
        return !! $this->favorites->where('user_id',auth()->id())->count();
    }
}

<?php


namespace App\Filters;

use App\Models\User;
class ThreadFilters extends Filter
{
    protected $filters = ['by'];

    /**
     * Filter a query by a given username
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::whereName($username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}


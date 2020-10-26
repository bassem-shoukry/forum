<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function show(User $profile)
    {
        return view('profiles.show',[
            'profileUser' => $profile,
            'threads' => $profile->threads()->paginate(20)
        ]);
    }
}

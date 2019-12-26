<?php

namespace App\Http\Controllers;

use App\Models\Channel;

class ChannelController extends Controller
{

    public function show(Channel $channel)
    {
        $threads = $channel->threads;
        return view('channels.show',compact('threads'));
    }
}

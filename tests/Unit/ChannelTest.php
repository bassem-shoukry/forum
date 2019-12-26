<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;

class ChannelTest extends TestCase
{
   /**
    * @test
    */
   public function a_channel_consists_of_threads()
   {
       $channel = create(Channel::class);

       $thread = create(Thread::class,['channel_id' => $channel->id]);

       $this->assertTrue($channel->threads->contains($thread));
   }
}

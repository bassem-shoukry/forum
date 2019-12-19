<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
   /**
    * @test
    */
   public function an_authenticated_user_may_participate_in_forum_threads()
   {
       $user = factory(User::class)->create();
       $this->be($user);

       $thread = factory(Thread::class)->create();

       $reply = factory(Reply::class)->make();

       $this->post(route('replies.store'),$reply->toArray());

       $this->get($thread->path())
           ->assertSee($reply->body);
   }
}

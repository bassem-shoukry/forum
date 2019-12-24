<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Tests\TestCase;
class ParticipateInForumTest extends TestCase
{
    protected $thread;
    protected function setUp(): void
    {
        parent::setUp();

        $this->thread =  create(Thread::class);

    }

    /**
     * @test
     */
    public function unauthenticated_user_may_can_not_add_replies()
    {
        $this->withExceptionHandling()->post(route('replies.store',$this->thread),[])
            ->assertRedirect('/login');
    }

   /**
    * @test
    */
   public function an_authenticated_user_may_participate_in_forum_threads()
   {
       $this->signIn();

       $reply = make(Reply::class);

       $this->post(route('replies.store',[$this->thread]),$reply->toArray());
       $this->get($this->thread->path())
           ->assertSee($reply->body);
   }

   /**
    * @test
    */
   public function a_reply_requires_a_body()
   {
       $this->signIn();
       $reply = make(Reply::class,['body' => null]);
       $this->post(route('replies.store',[$this->thread]),$reply->toArray())
           ->assertSessionHasErrors('body');
   }
}

<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    /**
     * @test
     */
    public function a_user_can_view_all_threads()
    {

        $this->get(route('threads.index'))
            ->assertSee($this->thread->title);

        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->body);
    }


    /**
     * @test
     */
    public function a_user_can_read_reply_that_are_associated_with_a_thead()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}

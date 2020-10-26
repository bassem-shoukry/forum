<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{

    private $thread;

    function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /**
     * @test
     */
    function a_user_can_view_all_threads()
    {

        $this->get(route('threads.index'))
            ->assertSee($this->thread->title);

        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    function a_user_can_read_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->body);
    }


    /**
     * @test
     */
    function a_user_can_read_replies_that_are_associated_with_a_thead()
    {
        $reply = create(Reply::class,['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**
     * @test
     */
    function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create(Channel::class);

        $threadInChannel = create(Thread::class,['channel_id' => $channel->id]);

        $threadNotInChannel = create(Thread::class);

        $this->get('channels/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /**
     * @test
     */
    function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create(User::class,['name' => 'BassemShoukry']));
        $threadByBassemShoukry = create(Thread::class,['user_id' => auth()->id()]);
        $threadNotBYBassemShoukry = create(Thread::class);

        $this->get('threads?by=BassemShoukry')
            ->assertSee($threadByBassemShoukry->title)
            ->assertDontSee($threadNotBYBassemShoukry->title);
    }
}

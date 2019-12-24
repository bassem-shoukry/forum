<?php

namespace Tests\Feature;

use App\Models\Thread;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    /**
     * @test
     */
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get(route('threads.create'))
            ->assertRedirect('/login');

        $this->post(route('threads.store'))
            ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->signIn();

        $thread = raw(Thread::class);

        $response = $this->post(route('threads.store'),$thread);

        $this->get($response->headers->get('Location'))
            ->assertSee($thread['title'])
            ->assertSee($thread['body']);
    }

    /**
     * @test
     */
    public function a_thread_required_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');

    }

    /**
     * @test
     */
    public function a_thread_required_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }


    /**
     * @test
     */
    public function a_thread_required_channel()
    {
        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');
    }



    /**
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function publishThread($overrides=[])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make(Thread::class,$overrides);

        return $this->post(route('threads.store'),$thread->toArray());
    }



}

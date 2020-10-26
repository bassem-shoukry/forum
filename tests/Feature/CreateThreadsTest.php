<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Tests\TestCase;
use Auth;
class CreateThreadsTest extends TestCase
{
    /**
     * @test
     */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get(route('threads.create'))
            ->assertRedirect('/login');

        $this->post(url('/threads'))
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    function an_authenticated_user_can_create_new_forum_thread()
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
     function a_thread_required_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');

    }

    /**
     * @test
     */
    function a_thread_required_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }


    /**
     * @test
     */
     function a_thread_required_channel()
    {
        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');
    }


    /**
     * @param array $overrides
     * @return \Illuminate\Testing\TestResponse
     */
     function publishThread($overrides=[])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make(Thread::class,$overrides);

        return $this->post(route('threads.store'),$thread->toArray());
    }

    /**
     * @test
     */
    function guests_cannot_delete_threads()
    {
        $thread = create(Thread::class);

        $this->delete(route('threads.destroy',[$thread->channel->name,$thread->id]))
            ->assertRedirect('/login');

    }

    /**
     * @test
     */
    function a_thread_can_be_deleted()
    {
        $this->signIn();

        $thread = create(Thread::class,['user_id' => Auth::id()]);

        $reply = create(Reply::class,['thread_id' => $thread->id]);

        $this->json('delete',$thread->path())
            ->assertStatus(204);


        $this->assertDatabaseMissing('replies',['id' => $reply->id]);

        $this->assertDatabaseMissing('threads',['id' => $thread->id]);

    }
}

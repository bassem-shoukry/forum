<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function guests_may_not_create_threads()
    {
        $this->expectException(AuthenticationException::class);
        $thread = factory(Thread::class)->raw();
        $this->post(route('threads.store'),$thread);
    }
    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_thread()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);
        $thread = factory('App\Thread')->raw();
        $this->followingRedirects()->post('/threads',$thread)
            ->assertSee($thread['title'])
            ->assertSee($user->name)
            ->assertSee($thread['body']);
    }
}

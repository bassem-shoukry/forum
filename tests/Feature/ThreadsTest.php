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

        $response = $this->get(route('threads.index'));

        $response->assertSee($this->thread->title);

        $response = $this->get(route('threads.show',$this->thread->id));

        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_single_thread()
    {
        $response = $this->get(route('threads.show',$this->thread->id));

        $response->assertSee($this->thread->title);
    }
}

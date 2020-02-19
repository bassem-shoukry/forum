<?php

namespace Tests\Feature;

use App\Models\Reply;
use Tests\TestCase;

class FavoritesTest extends TestCase
{

    /**
     * @test
     */
    public function guests_can_not_favorite_any_reply()
    {
        $reply = create(Reply::class);

        $this->post('replies/'. $reply->id . '/favorites')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->post('replies/'. $reply->id . '/favorites');

        $this->assertCount(1,$reply->favorites);
    }

    /**
     * @test
     */
    function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create(Reply::class);

        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}

<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
   /**
    * @test
    */
   public function it_has_an_owner()
   {
       $reply = factory('App\Reply')->create();

       $this->assertInstanceOf(User::class,$reply->owner);
   }
}

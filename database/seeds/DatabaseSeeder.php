<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Channel::class,10)->create()->each(function ($channel){
            factory(\App\Models\Thread::class,20)->create(['channel_id' => $channel->id])->each(function ($thread){
                factory(\App\Models\Reply::class,10)->create(['thread_id' => $thread->id]);
            });
        });
    }
}

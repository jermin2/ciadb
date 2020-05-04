<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Event::class, 10)->create()->each(function($u) {
            $tag_ids = \App\Tag::all()->random(rand(1,4));
            
            foreach($tag_ids as $tag_id)
            {
                DB::table('event_tag')->insert(
                    [
                        'event_id' => $u->id, 
                        'tag_id' => $tag_id->id
                    ]
                );
            }
        });
    }
}

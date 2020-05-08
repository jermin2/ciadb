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

            //Add some random tags
            $tag_ids = array(\App\Tag::where('tagtype_id', 1)->get()->random());
            $tag_ids[] = \App\Tag::where('tagtype_id', 2)->get()->random();
            $tag_ids[] = \App\Tag::where('tagtype_id', 3)->get()->random();
            
            foreach($tag_ids as $tag_id)
            {
                DB::table('event_tag')->insert(
                    [
                        'event_id' => $u->id, 
                        'tag_id' => $tag_id->id
                    ]
                );
            }

            //Add some random people
            $people = \App\Person::all()->random(rand(1,5));

            foreach($people as $person)
            {
                DB::table('event_person')->insert(
                    [
                        'event_id' => $u->id, 
                        'person_id' => $person->id
                    ]
                );
            }
        });
    }
}

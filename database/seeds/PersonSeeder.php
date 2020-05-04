<?php

use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Person::class, 10)->create()->each(function($u) {
            
            $tag_ids = \App\Tag::all()->random(rand(1,4));
            
            foreach($tag_ids as $tag_id)
            {
                DB::table('person_tag')->insert(
                    [
                        'person_id' => $u->id, 
                        'tag_id' => $tag_id->id
                    ]
                );
            }

        });
    }
}

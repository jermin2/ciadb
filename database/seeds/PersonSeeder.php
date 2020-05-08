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

            $tag_ids = array(\App\Tag::where('tagtype_id', 1)->get()->random());
            $tag_ids[] = \App\Tag::where('tagtype_id', 2)->get()->random();

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

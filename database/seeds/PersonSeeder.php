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
            DB::table('person_tag')->insert(
                [
                    'person_id' => $u->id, 
                    'tag_id' => \App\Tag::all()->random()->id
                ]
            );
        });
    }
}

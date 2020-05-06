<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagtypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('tagtypes')->insert([
            [
                'name' => 'location'
            ],
            [
                'name' => 'age_group'
            ]
        ]);

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('tagtype_id');
            $table->string('color')->default('#0000F0');
            $table->timestamps();

            $table->foreign('tagtype_id')
                ->references('id')
                ->on('tagtypes')
                ->onDelete('cascade');
        });

        
        DB::table('tags')->insert([
            [
                'name' => 'hall1', 'tagtype_id' => '1', 'color' => '#0000F0',
            ],
            [
                'name' => 'hall2', 'tagtype_id' => '1', 'color' => '#E00000',
            ],
            [
                'name' => 'hs', 'tagtype_id' => '2', 'color' => '#00C000',
            ],
            [
                'name' => 'int', 'tagtype_id' => '2', 'color' => '#FF00FF',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagtypes');
        Schema::dropIfExists('tags');
    }
}

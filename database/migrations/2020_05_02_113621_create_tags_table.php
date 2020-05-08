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
            ],
            [
                'name' => 'event_type'
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
            [ 'name' => 'hall1', 'tagtype_id' => '1', 'color' => '#808000'],
            [ 'name' => 'hall3', 'tagtype_id' => '1', 'color' => '#000000'],
            [ 'name' => 'hall4', 'tagtype_id' => '1', 'color' => '#0000FF'],
            [ 'name' => 'hall5', 'tagtype_id' => '1', 'color' => '#E00000'],
            [ 'name' => 'hs', 'tagtype_id' => '2', 'color' => '#00C000'],
            [ 'name' => 'int', 'tagtype_id' => '2', 'color' => '#FF00FF'],
            [ 'name' => 'yp', 'tagtype_id' => '2', 'color' => '#008000'],
            [ 'name' => 'meet', 'tagtype_id' => '3', 'color' => '#800080'],
            [ 'name' => 'apt', 'tagtype_id' => '3', 'color' => '#800000'],
            [ 'name' => 'church', 'tagtype_id' => '3', 'color' => '#006000']
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

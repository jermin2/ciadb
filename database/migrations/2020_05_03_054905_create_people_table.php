<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
        });

        Schema::create('person_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->unique(['person_id', 'tag_id']);

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::table('users', function($table){
            $table->foreign('person_id')->references('id')->on('people')->onDelete('set null');
        });

        DB::table('people')->insert([
            [ 'first_name' => 'guest', 'last_name' => 'user'],
        ]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_tag');
        Schema::dropIfExists('people');
        
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#848686');
            $table->unsignedBigInteger('user_id');
        });

        Schema::create('event_usertag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('usertag_id');

            //If event_id gets deleted, delete this relationship
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('usertag_id')->references('id')->on('usertags')->onDelete('cascade');
        });

        Schema::create('person_usertag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('usertag_id');

            //If person gets deleted, delete this relationship
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('usertag_id')->references('id')->on('usertags')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usertags');
    }
}

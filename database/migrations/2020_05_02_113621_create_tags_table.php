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
            $table->timestamps();

            $table->foreign('tagtype_id')
                ->references('id')
                ->on('tagtypes')
                ->onDelete('cascade');
        });

        
        DB::table('tags')->insert([
            [
                'name' => 'hall1', 'tagtype_id' => '1'
            ],
            [
                'name' => 'hall2', 'tagtype_id' => '1'
            ],
            [
                'name' => 'hs', 'tagtype_id' => '2'
            ],
            [
                'name' => 'int', 'tagtype_id' => '2'
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

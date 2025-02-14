<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTagsTable
{
    public function up()
    {
        Capsule::schema()->create('tags', function($table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('tags');
    }

}
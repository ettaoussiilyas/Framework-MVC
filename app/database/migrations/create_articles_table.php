<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateArticlesTable
{
    public function up()
    {
        Capsule::schema()->create('articles', function($table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('articles');
    }
} 
<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable
{
    public function up()
    {
        Capsule::schema()->create('users', function($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('users');
    }
} 
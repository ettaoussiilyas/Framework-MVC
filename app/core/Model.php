<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    // Base model functionality
    protected $guarded = ['id'];  // Mass assignment protection
} 
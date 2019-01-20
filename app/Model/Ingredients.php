<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model {
    
    protected $table = 'list_ingredients';

    protected $fillable = [
        'name_ingredients'
    ];
    
    public $timestamps = false;

}
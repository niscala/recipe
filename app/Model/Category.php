<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    
    protected $table = 'list_category';

    protected $fillable = [
        'name_category'
    ];
    
    public $timestamps = false;

}

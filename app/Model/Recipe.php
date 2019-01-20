<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {

    protected $table = 'recipes';

    protected $fillable = [
        'name_recipe',
        'id_category',
        'images',
        'code_num'
    ];

    public $timestamps = false;

    public function scopeGetRecipe($query) {
        return $query->join('list_category', 'recipes.id_category', '=', 'list_category.id')
            ->select('recipes.*',  'list_category.name_category')->orderBy('recipes.id','DESC')->get();
    }

    public function scopeFindRecipe($query, $id) {
        return $query->join('list_category', 'recipes.id_category', '=', 'list_category.id')
            ->select('recipes.*',  'list_category.name_category')
            ->where('recipes.id', '=', $id)->limit(1)->get();
    }

    public function scopeChecking($query) {
        return $query->select('id_category')
            ->groupBy('id_category')->get();
    }

}
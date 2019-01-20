<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RecipeIng extends Model {
    
    protected $table = 'recipes_ingredients';

    protected $fillable = [
        'id_recipe',
        'id_ingredients',
        'amount',
        'code_num_ing'
    ];

    public $timestamps = false;

    public function scopeFindRecIng($query, $id) {
        return $query->join('list_ingredients', 'recipes_ingredients.id_ingredients', '=', 'list_ingredients.id')
            ->select('recipes_ingredients.*', 'list_ingredients.name_ingredients')
            ->where('recipes_ingredients.id_recipe', '=', $id)->get();
    }

    public function scopeChecking($query) {
        return $query->select('id_ingredients')
            ->groupBy('id_ingredients')->get();
    }

}
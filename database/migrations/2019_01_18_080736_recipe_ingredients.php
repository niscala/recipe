<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipeIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_recipe');
            $table->foreign('id_recipe')->references('id')->on('recipes');
            $table->unsignedInteger('id_ingredients');
            $table->foreign('id_ingredients')->references('id')->on('list_ingredients');
            $table->string('amount', '50');
            $table->string('code_num_ing', '4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes_ingredients');
    }
}

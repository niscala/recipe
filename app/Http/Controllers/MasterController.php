<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Ingredients;
use App\Model\Recipe;
use App\Model\RecipeIng;

class MasterController extends Controller {

    public function indexCategory() {
        $dataCategory = Category::all();
        $checkCategory = Recipe::Checking();
        return view('mCategory')
            ->with(compact('dataCategory'))
            ->with(compact('checkCategory'));
    }

    public function doAddCategory(Request $request) {
        $validatedData = $request->validate([
            'name_category' => 'required'
        ]);
        $dataCat = new Category ([
            'name_category' => $request->name_category
        ]);
        $dataCat->save();
        return redirect('/lihat-kategori');
    }

    public function doEditCategory(Request $request) {
        $validatedData = $request->validate([
            'name_category' => 'required'
        ]);
        $dataCat = Category::find($request->id);
        $dataCat->name_category = $request->name_category;
        $dataCat->save();
        return redirect('/lihat-kategori');
    }

    public function delCategory(Request $request) {
        $dataCat = Category::find($request->id);
        $dataCat->delete();
        return redirect('/lihat-kategori');
    }

    public function indexIngredients() {
        $dataIng = Ingredients::all();
        $checkIng = RecipeIng::Checking();
        return view('mIngredients')
            ->with(compact('dataIng'))
            ->with(compact('checkIng'));
    }

    public function doAddIngredients(Request $request) {
        $validatedData = $request->validate([
            'name_ingredients' => 'required'
        ]);
        $dataIng = new Ingredients ([
            'name_ingredients' => $request->name_ingredients
        ]);
        $dataIng->save();
        return redirect('/lihat-bahan');
    }

    public function doEditIngredients(Request $request) {
        $validatedData = $request->validate([
            'name_ingredients' => 'required'
        ]);

        $dataIng = Ingredients::find($request->id);
        $dataIng->name_ingredients = $request->name_ingredients;
        $dataIng->save();
        return redirect('/lihat-bahan');
    }

    public function delIngredients(Request $request) {
        $dataIng = Ingredients::find($request->id);
        $dataIng->delete();
        return redirect('/lihat-bahan');
    }

}

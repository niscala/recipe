<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Recipe;
use App\Model\Category;
use App\Model\Ingredients;
use App\Model\RecipeIng;

class RecipeController extends Controller {
   
    public function index() {
        $dataRecipe = Recipe::GetRecipe();
        $dataCat = Category::all();
        return view('listRecipe')
            ->with(compact('dataRecipe'))
            ->with(compact('dataCat'));
    }

    public function create() {
        $dataCategory = Category::all();
        $dataIngredients = Ingredients::all();
        return view('createRecipe')
            ->with(compact('dataCategory'))
            ->with(compact('dataIngredients'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name_recipe' => 'required',
            'id_category' => 'required',
            'id_ingredients' => 'required',
            'amount' => 'required',
        ]);
        $randNum = rand(0000,9999);
        if ($request->images != null) {
            $destinationPath = public_path('images/');
            $tmp_images = $request->images;
            $tmp_images = str_replace('data:image/png;base64,', '', $tmp_images);
            $tmp_images = str_replace(' ', '+', $tmp_images);
            $images = base64_decode($tmp_images);
            $file_name = uniqid() . '.png';
            $file_images = $destinationPath . $file_name;
            $success = file_put_contents($file_images, $images);
        } else {
            $file_name = 'default-image.png';
        }
      
        $recipes = new Recipe([
            'name_recipe' => $request->name_recipe,
            'id_category' => $request->id_category,
            'images' => $file_name,
            'code_num' => $randNum,
        ]);
        $recipes->save();
        $tmpIdRecipes = Recipe::where('code_num', '=', $randNum)
            ->select('id')->limit(1)->get();
        foreach ($tmpIdRecipes as $IdRecipes) {
            $idRecipe = $IdRecipes->id;
        }
        $idIng = $request->id_ingredients;
        $amount = $request->amount;
        $countData = count($idIng);
        $codeNumIng = rand(0000, 9999);
        for($i = 0; $i < $countData; $i++) {
            $data = array(
                'id_recipe' => $idRecipe,
                'id_ingredients' => $idIng[$i],
                'amount' => $amount[$i],
                'code_num_ing' => $codeNumIng
            );
            $insertData[] = $data;
        }
        $dataRecIng = RecipeIng::insert($insertData);
        return redirect('/');
    }

    public function show(Request $request) {
        $id = $request->id;
        $dataRecipe = Recipe::FindRecipe($id);
        $dataIngredients = RecipeIng::FindRecIng($id);
        return view('detailRecipe')
            ->with(compact('dataRecipe'))
            ->with(compact('dataIngredients'));
    }

    public function destroy(Request $request) {
        $delRecIng = RecipeIng::where('id_recipe', '=', $request->id);
        $delRecIng->delete();
        $delRecipe = Recipe::find($request->id);
        $delRecipe->delete();
        return redirect('/');
    }

    public function getIngUnit() {
        $dataIngredients = Ingredients::all();
        echo json_encode($dataIngredients);
    }

    public function addIng(Request $request) {
        $codeNumIng = rand(0000, 9999);
        $dataIng = array(
            'id_recipe' => $request->id_recipe,
            'id_ingredients' => $request->id_ingredients,
            'amount' => $request->amount,
            'code_num_ing' => $codeNumIng
        );
        $insert = RecipeIng::insert($dataIng);
        $dataIdIng = RecipeIng::where('code_num_ing', '=', $codeNumIng)->limit(1)->get();
        echo json_encode($dataIdIng);
    }

    public function editIng(Request $request) {
        $id = $request->id;
        $dataIng = RecipeIng::find($id);
        $dataIng->amount = $request->amount;
        $dataIng->save();  
    }

    public function delIng(Request $request) {
        $id = $request->id;
        $delete = RecipeIng::find($id);
        $delete->delete();
    }

    public function updateImg(Request $request) {
        $id = $request->id;
        $destinationPath = public_path('images/');
        $tmp_images = $request->images;
		$tmp_images = str_replace('data:image/png;base64,', '', $tmp_images);
        $tmp_images = str_replace(' ', '+', $tmp_images);
		$images = base64_decode($tmp_images);
        $file_name = uniqid() . '.png';
        $file_images = $destinationPath . $file_name;
        $success = file_put_contents($file_images, $images);
        $dataRec = Recipe::find($id);
        $dataRec->images = $file_name;
        $dataRec->save();
    }

    public function getCategory() {
        $dataCategory = Category::all();
        echo json_encode($dataCategory);
    }

    public function upRecipeName(Request $request) {
        $upRecipe = Recipe::find($request->id);
        $upRecipe->name_recipe = $request->name_recipe;
        $upRecipe->id_category = $request->id_category;
        $upRecipe->save();
    }

}
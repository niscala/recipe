<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Ingredients as IngResource;
use App\Model\Ingredients;

class ApiController extends Controller {

    public function index() {
        return IngResource::collection(Ingredients::all());
    }

    public function show($id) {
        return new IngResource(Ingredients::find($id));
    }
    
}

<?php

namespace App\Http\Controllers\Api\Master;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \Firebase\JWT\JWT;

use App\Models\Master\Category;

class CategoryController extends Controller
{

    public function data(Request $request)
    {
        # query
        $query = Category::table()->orderBy('category_name');
        $categories = $query->get();

        return response()->json([
            'categories' => $categories,
            'status' => True
        ]);
    }

}

<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class AjaxSearchController extends Controller
{
    public function dataAjax(Request $request, Product $product)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = $product
                ->select("id","title")
                ->where('title','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }
}

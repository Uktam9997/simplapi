<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        return Response::json(Product::all());
    }

    public function store(Request $request){
        $result = Validator::make($request->only([
            'name' => 'required|unique:products|alpha_num',
            'prise' => 'required|digits'
        ]));

        if($result->fails()){
            return Response::json([
                'messege' => 'error',
                'errors' => $result->errors(),
            ], 400);
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return Response::json($product, 201);
    }

    public function show($id){
        $product = Product::find($id);
        if(!$product){
            return Response::json([
                'messege' => 'Product not found'
            ], 404);
        }

        return Response::json($product);
    }

    public function update(){

    }

    public function destroy(){

    }
}

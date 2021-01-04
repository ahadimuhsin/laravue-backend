<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function all(Request $request){
        $id = $request->id;
        $limit = $request->input('limit', 10);
        $name = $request->name;
        $slug = $request->slug;
        $type = $request->type;
        $price_from = $request->price_from;
        $price_to = $request->price_to;

        if($id){
            $product = Product::with('product_galleries')->find($id);
            if ($product){
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            }
            else{
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);

            }
        }

        if($slug){
            $product = Product::with('product_galleries')
            ->where('slug', '=', $slug)
            ->first();
            if ($product) {
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        }

        $product = Product::with('product_galleries');
        if($name){
            $product->where('name', 'like', '%'.$name.'%');
        }
        if($type){
            $product->where('type', 'like', '%' . $type . '%');

        }

        if($price_from){
            $product->where('price', '>=', $price_from);
        }

        if($price_to){
            $product->where('price', '<=', $price_to);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data Produk'
        );
    }
}

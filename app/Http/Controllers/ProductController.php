<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product($id){
        $productById= Product::find($id);
        $product = Product::all();

        return view('frontEnd.products.product',[
            'productById'=>$productById,
            'product'=>$product
        ]);
    }

    public function createProduct(Request $request){
        if ($request->productId==0) {
            $product = new Product();
            $product->productNumber = $request->productNumber;
            $product->productName = $request->productName;
            $product->sellingPrice = $request->sellingPrice;
            $product->sellingUnit = $request->sellingUnit;
            $product->status = $request->status;
            $product->save();
//            DB::select('call insertProduct(?,?,?,?)', [$request->productNumber,$request->productName,$request->sellingPrice,$request->sellingUnit]);
            return redirect('product/0')->with('message', 'Customer has been created successfully.');
        }else{
            $product = Product::find($request->productId);
            $product->productNumber = $request->productNumber;
            $product->productName = $request->productName;
            $product->sellingPrice = $request->sellingPrice;
            $product->sellingUnit = $request->sellingUnit;
            $product->status = $request->status;
            $product->save();
            return redirect('product/0')->with('updateMessage', 'Customer has been added successfully.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product-add');
    }

    public function productlist()
    {

        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product-list', [
            'products'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,pdf,jpg,gif,svg|max:2048',
        ]);

        // return request()->get('category_id');
        // die;
    
        $image = time().'.'.$request->img->extension();       
        $request->img->move(public_path('products'), $image);  
        $product = Product::create([  
              'category_id' => request()->get('category_id'),
              'product_name' => request()->get('product_name'),
              'image' => 'products/'.$image,
              'price' => request()->get('price'),
              'color' => request()->get('color'),
              'size' => request()->get('size'),
              'description' => request()->get('desc'),
              'status' => request()->get('status'),
              
           ]);

   
           return back()->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
           $product = Product::find($id);
           
           return view('admin.product-edit', [
            'product' => $product,
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if($product){

            $product->product_name = $request->get('product_name');
            $product->price = $request->get('price');
            $product->size = $request->get('size');
            $product->save();

        }

        return back()->with('success', 'Product Updated Sucessfully');

    }

    public function status(Request $request, string $id)
    {
        $product = Product::find($id);

        if($product){

            if($product->status == 1){

                    $product->status = 0;
                    $product->save();

            } else {

                $product->status = 1;
                    $product->save();

            }

              
        }

        // return back()->with('success', 'Product Updated Sucessfully');

        return response()->json(['message' => 'Product disable successfully']);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

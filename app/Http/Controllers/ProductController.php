<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $product = Product::find($id);
        return view('fashion.product_view', compact('product'));
    }

    // public function products()
    // {

    //     return view('fashion.product_view', compact('product'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function additem(Request $request, $id){

        $arrayInSession = $request->session()->get('ids', []); // Get the current array from the session or create an empty array if it doesn't exist
        $arrayInSession[] = $id; // Add the received ID to the array
        $request->session()->put('ids', $arrayInSession); // Store the updated array back in the session
        
        // return back()->with('success', 'Product Added');

        $array = [];

        $items = $request->session()->get('ids');

        array_push($array, $items);

        // $count = count($array);
        
        $carts = Product::find($array);
        
        // $products = Product::orderBy('created_at', 'desc')->get();

        
                                    
        $this->minicart($request);

        return response()->json([  'carts' => $carts, 
                                  
                                    'message' => 'Product added successfully']);


    }


    public function minicart(Request $request){


        $array = [];

        $items = $request->session()->get('ids');

        array_push($array, $items);

        // $count = count($array);
        
        $carts = Product::find($array);
        
        // $products = Product::orderBy('created_at', 'desc')->get();

        return response()->json($carts);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Return success response
        return response()->json(['message' => 'Product deleted successfully']);
           
    }
}

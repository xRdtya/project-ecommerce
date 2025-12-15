<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        
        return view('main', compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller_dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request);
        $validated = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'required|image|file|max:2048',
            'description' => 'required',
            'seller' => 'required',
            'price' => 'required'
        ]);
        
        $validated['image'] = $request->file('image')->store('images', 'public');

        Product::create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('upload');
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
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

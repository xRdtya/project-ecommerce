<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    public function seller()
    {
        return view('seller_dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function create(Product $product)
    {
        return view('upload');
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

    // Order Form
    public function order(StoreProductRequest $request)
    {
        // $validated = $request->validate([

        // ]);

        $items = json_decode($request->item);

        // dd($request);

        Mail::to('tysaluthfia1@gmail.com')->send(new OrderMail($request, $items));

        return redirect('/');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'upc'   => 'digits:12'
        ]);

        $data = $request->all();

        $data['status'] = isset($data['status']) ? 1 :0;

        $product = Product::create($data);

        if ($request->has('image')) {
            $this->storeImage($product);
        }

        session()->flash('status', 'Product created successfully');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'upc'   => 'digits:12'
        ]);

        $product = Product::find($id);

        $data = request()->all();

        $data['status'] = isset($data['status']) ? 1 :0;

        $product->update($data);
        
        $this->storeImage($product);

        session()->flash('status','Product has been updated successfully');

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        session()->flash('status','Product has been deleted successfully');

        return redirect()->route('home');

    }
    
    /**
     * mutlidelete
     */
    public function multidestroy()
    {
        $productIds  = request()->all();

        foreach ($productIds as $productId) {

            $product = Product::find($productId)->first();

            if ($product) {
                $product->delete();
            }
        }

        session()->flash('status','Selected Product has been deleted successfully');

        return response()->json(['status'=> 200]);

    }

    /**
     * store product image
     */
    public function storeImage ($product)
    {    
       if (request()->hasFile('image')) {
        $path = request()->file('image')->storeAs(
            'product', $product->id
        );

        $product->image = $path;
        $product->save();
       }
    }
}

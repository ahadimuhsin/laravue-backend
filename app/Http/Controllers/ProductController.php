<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\productGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $products = Product::paginate(10);
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create product page
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        if($product){
            return redirect()->route('products.index')
            ->with('success', 'Data ' . $product->name . ' berhasil disimpan');
        }
        else{
            return redirect()->route('products.index')
            ->with('error', 'Data '.$product->name.' gagal disimpan');
        }
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
        //
        $product = Product::findOrFail($id);

        return view('pages.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('products.index')->with(
            ['success' => 'Data '.$product->name.' berhasil diubah!']
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);

        $product->delete();

        //hapus gallery juga setelah productnya dihapus
        productGallery::where('product_id',$product->id)
        ->delete();

        return redirect()->route('products.index')->with(
            ['success' => 'Data berhasil dihapus']
        );
    }

    public function gallery (Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $items = productGallery::with('product')
        ->where('product_id', $id)->paginate(10);

        return view('pages.products.gallery', compact('product', 'items'));
    }
}

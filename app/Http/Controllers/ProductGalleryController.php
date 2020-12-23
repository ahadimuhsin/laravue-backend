<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productGallery;
use App\Models\Product;
use App\Http\Requests\GalleryRequest;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galleries = productGallery::with('product')->paginate(10);
        return view('pages.product-galleries.index', ["items" => $galleries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        return view('pages.product-galleries.create', ["products" => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        //
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/product', 'public'
        );

        $gallery = productGallery::create($data);

        if ($gallery) {
            return redirect()->route('product-gallery.index')
            ->with('success', 'Data  berhasil disimpan');
        } else {
            return redirect()->route('product-gallery.index')
            ->with('error', 'Data gagal disimpan');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $gallery = productGallery::findOrFail($id);

        $gallery->delete();

        return redirect()->route('product-gallery.index')
        ->with(['success' => 'Data berhasil dihapus']);
    }
}

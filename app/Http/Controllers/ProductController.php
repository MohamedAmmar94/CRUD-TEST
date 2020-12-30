<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use App\Models\AppImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products=Product::paginate(10);
        $products=Product::get();
        $categories=Category::get();
        return view('pages.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();

        return view('pages.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request->images);
        $product=Product::create($request->except('_token','images'));
        return redirect()->route("products.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Category::get();

        return view('pages.products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->except(['logo']));
        return redirect()->route("products.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
         return redirect()->route("products.index");
    }
    public function delete_image( $id)
    {
        $img=AppImage::find($id);
            if(!empty($img)){
                if (file_exists(storage_path('app/public/uploads/product' . "/" . $img->image))) {
                    $old_img=\App\Http\Controllers\ImageController::delete_single_file($img->image, 'app/public/uploads/product');
                }
                $img->delete();
                return true;
            }
            return false;
    }
}

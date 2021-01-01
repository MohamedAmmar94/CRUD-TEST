<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\AppImage;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$categories=Category::paginate(10);
        $categories=Category::get();
        //dd($categories);
        return view('pages.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();

        return view('pages.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {//dd($request->all());
//$request->except('_token')
        $category=Category::create($request->except('_token','logo'));
        return redirect()->route("categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('pages.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories=Category::get();

        return view('pages.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
         $category->update($request->except(['logo']));
         return redirect()->route("categories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {//dd($category->childs);
        if ($category->childs()->exists() ||$category->products()->exists() )
        {
             Session::flash('error', "you cannot delete category contain products or sub categories if you want i will change relation to cascade");
            return redirect()->route("categories.index");
        }
        $category->delete();
         return redirect()->route("categories.index");
    }
    public function delete_logo( $id)
    {
        $img=AppImage::find($id);
            if(!empty($img)){
                if (file_exists(storage_path('app/public/uploads/category' . "/" . $img->image))) {
                    $old_img=\App\Http\Controllers\ImageController::delete_single_file($img->image, 'app/public/uploads/category');
                }
                $img->delete();
                return true;
            }
            return false;
    }
}

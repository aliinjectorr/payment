<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $categoires = \Auth::user()->shop()->first()->ProductCategories()->get();
        return view('dashboard.shop.product-category', compact('categoires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
      $productCategory = new ProductCategory;
    $productCategory->name = $request->name;
    $productCategory->description = $request->description;
    $productCategory->shop_id = \Auth::user()->shop()->first()->id;
    $productCategory->save();
    alert()->success('دسته بندی جدید شما باموفقیت اضافه شد.', 'ثبت شد');
    return redirect()->route('product-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        dd($request);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $productCategory = \Auth::user()->shop()->first()->ProductCategories()->where('id',$id)->get()->first()->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);


        alert()->success('دسته بندی جدید شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('product-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory , Request $request)
    {
      $productCategory = ProductCategory::find($request->id);
              if ($productCategory->shop->user_id !== \Auth::user()->id) {
                  alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
                  return redirect()->back();
              }
               $productCategory->delete();
               alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
               return redirect()->back();
           }
}
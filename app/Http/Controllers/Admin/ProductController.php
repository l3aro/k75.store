<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $products = Product::with('category')->paginate(4);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getSubCategories(0);
        return view('admin.product.create', compact('categories'));
    }

    private function getSubCategories($parent_id, $process_id=null)
    {
        $categories = Category::where('parent_id', $parent_id)->where('id', '<>', $process_id)->get();
        if ($categories->count()) {
            $categories = $categories->map(function($category) use($process_id) {

                $category->sub = $this->getSubCategories($category->id, $process_id);
                return $category;
            });

        }

        return $categories;
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
            'category_id' => 'required|numeric|min:0',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'avatar' => 'sometimes|image'
        ]);

        $attributes = $request->only([
            'category_id', 'product_code', 'name', 'price', 'is_highlight', 'quantity', 'detail', 'description'
        ]);

        if ($request->hasFile('avatar')) {
            $destinationDir = public_path('media/product'); 
            $extension = $request->avatar->extension();
            $fileName = uniqid('vietpro'). '.' .$extension;
            $request->avatar->move($destinationDir, $fileName);
            $attributes['avatar'] = asset('media/product/'.$fileName);
        }

        $product = Product::create($attributes);

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Tạo sản phẩm thành công');
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
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
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
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([], 204);
    }
}

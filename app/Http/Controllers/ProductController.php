<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id');

        $category = request('category');
        $name = request('name');

        $paginate = 3;

        $products = new Product;

        if (!empty($category)) {
            $products = $products->where('category_id', $category);
        }

        if (!empty($name)) {
            $products = $products->orWhere('name', 'LIKE', "%{$name}%");
        }

        $products = $products->paginate($paginate);

        return view('admin.products.index', compact(
            'categories',
            'category',
            'name',
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [
            'name'          => 'required',
            'sku'           => 'required',
            'price'         => 'required',
            'status'        => 'required',
            'description'   => 'required',
            'category_id'   => 'required'
        ];

        $messages = [
            'name.required'        => 'Nama tidak boleh kosong',
            'sku.required'         => 'SKU tidak boleh kosong',
            'price.required'       => 'Price tidak boleh kosong',
            'status.required'      => 'Status tidak boleh kosong',
            'description.required' => 'Description tidak boleh kosong',
            'category_id.required' => 'Category tidak boleh kosong'
        ];

        $validator  = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(request()->all());
        }

        $image = request()->file('image');

        $input = request()->all();

        $input['image'] = $image != '' ? $image->store('products', 'public') : null;


        $create = Product::create($input);

        session()->flash('message', 'Data has been saved');

        return redirect()->route('products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('admin.products.show', compact(
            'product',
            'categories'
        ));
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

        $categories = Category::pluck('name', 'id');

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
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
        $rules = [
            'name'          => 'required',
            'sku'           => 'required',
            'price'         => 'required',
            'status'        => 'required',
            'description'   => 'required',
            'category_id'   => 'required'
        ];

        $messages = [
            'name.required'        => 'Nama tidak boleh kosong',
            'sku.required'         => 'SKU tidak boleh kosong',
            'price.required'       => 'Price tidak boleh kosong',
            'status.required'      => 'Status tidak boleh kosong',
            'description.required' => 'Description tidak boleh kosong',
            'category_id.required' => 'Category tidak boleh kosong'
        ];

        $validator  = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(request()->all());
        }

        $product = Product::findOrFail($id);

        $input = request()->all();

        $image = request()->file('image');

        $input['image'] = $image != '' ? $image->store('products', 'public') : $product->image;

        $product->fill($input);

        $product->save();

        session()->flash('message', 'Data has been updated');

        return redirect()->route('products.index');

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

        session()->flash('message', 'Data has been deleted');

        return redirect()->route('products.index');
    }
}

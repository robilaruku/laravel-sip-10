<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store()
    {
        $categories = request()->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $category = Category::create($categories);

        session()->flash('message', 'Data saved successffully');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        $categories = request()->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        Category::where('id', $category->id)->update($categories);

        session()->flash('message', 'Data updated successffully');

        return redirect()->route('categories.index');

    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Data deleted successffully');

        return redirect()->route('categories.index');
    }
}

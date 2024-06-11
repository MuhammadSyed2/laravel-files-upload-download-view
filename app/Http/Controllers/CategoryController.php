<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('welcome', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $category = Category::create($data);
        return redirect()->route('category.index');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png, jpg, jpeg, webp',
            'status' => 'required'
        ]);

        $category->update($data);
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $dcat = Category::find($category->id);
        $dcat->delete();
        return redirect()->route('category.index');
    }
}

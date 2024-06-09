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

    public function update()
    {
        return redirect()->route('category.index');
    }

    public function destroy()
    {
        return redirect()->route('category.index');
    }
}

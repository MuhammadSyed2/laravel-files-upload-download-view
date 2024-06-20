<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'image' => 'nullable',
            'status' => 'required'
        ]);

        if ($request -> has('image')) {
            $file = $request->file('image');
            $fextension = $file->getClientOriginalExtension();
            if ($fextension == 'jpg' || $fextension == 'jpeg' || $fextension == 'png' || $fextension == 'webp') {
                $path = 'upload/category/image/';
            }
            elseif ($fextension == 'csv' || $fextension == 'xlsx') {
                $path = 'upload/category/excel/';
            }
            // $path = $file->getClientOriginalPath();
            $filename = time().'.'.$fextension;
            // $path = 'upload/category/';
            $file->move($path, $filename);
        }

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path.$filename,
            'status' => $request->status
        ]);
        return redirect()->route('category.index');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'status' => 'required'
        ]);

        $ct = Category::findOrFail($category->id);

        if ($request -> has('image')) {
            $file = $request->file('image');
            $fextension = $file->getClientOriginalExtension();
            if ($fextension == 'jpg' || $fextension == 'jpeg' || $fextension == 'png' || $fextension == 'webp') {
                $path = 'upload/category/image/';
            }
            elseif ($fextension == 'csv' || $fextension == 'xlsx') {
                $path = 'upload/category/excel/';
            }
            // $path = $file->getClientOriginalPath();
            $filename = time().'.'.$fextension;
            // $path = 'upload/category/';
            $file->move($path, $filename);
        }
        
        if (File::exists($ct->image)) {
            File::delete($ct->image);
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path.$filename,
            'status' => $request->status
        ]);
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $dcat = Category::findOrFail($category->id);
        if (File::exists($dcat->image)) {
            File::delete($dcat->image);
        }
        $dcat->delete();
        return redirect()->route('category.index');
    }
}

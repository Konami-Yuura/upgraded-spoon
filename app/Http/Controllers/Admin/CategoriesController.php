<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(3);

        return view('admin.categories.index')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        /** 
         * $name = 'ANNA'
         * $newWord = ucwords($name) = "Anna"
         *  
         * Category name format: Education, Food, Movie
         **/
        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name' . $id
        ]);

        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->name));
        $category->save();

        return redirect()->back();

    }
}

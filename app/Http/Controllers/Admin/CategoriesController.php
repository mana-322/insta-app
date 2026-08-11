<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
     private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {

        $all_categories = $this->category->withCount('categoryPost')
                                        ->where('name', '!=', 'Uncategorized')->latest()->paginate(10);

        $uncategorized = $this->category
        ->withCount('categoryPost')
        ->where('name', 'Uncategorized')
        ->first();

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                             ->with('uncategorized', $uncategorized);
                                             
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,' . $id
        ]);

       $category = $this->category->findOrFail($id);

   
        $category->name = $request->name;
        $category->save();

        return redirect()->back();

    }

   public function destroy($id)
{
   
    $uncategorized = $this->category->where('name', 'Uncategorized')->firstOrFail();

    if ($uncategorized) {
        $category = $this->category->findOrFail($id);

        $category->categoryPost()->update([
            'category_id' => $uncategorized->id
        ]);
    }

    $this->category->destroy($id);

    return redirect()->back();
}

  

}



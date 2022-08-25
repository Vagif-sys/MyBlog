<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Category;

class AdminCategoryController extends Controller
{
    private $rules = [
        'name'=> 'required|min:3|max:30',
        'slug'=> 'required|unique:categories,slug',
    ];
    public function index()
    {
       return view('admin_dashboard.categories.index',[
            'categories'=> Category::with('user')->paginate(5),
       ]);
    }

    
    public function create()
    {
        
        return view('admin_dashboard.categories.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        Category::create($validated);

        return redirect()->route('admin.categories.create')->with('success','Category has been created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin_dashboard.categories.show',[
            'category'=> $category
        ]);
    }

   
    public function edit(Category $category)
    {

        return view('admin_dashboard.categories.edit',[
            'category'=> $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->rule['slug'] = ['required', Rule::unique('categories')->ignore($category)];
        $validated = $request->validate($this->rules);

        $category->update($validated);

        return redirect()->route('admin.categories.edit',$category)->with('success','Category has been updated');

    }

    public function destroy(Category $category)
    {
        $default_cat_id = Category::where('name','uncategorized')->first()->id;
        dd($default_cat_id);
        $category->posts()->update(['category_id'=>$default_cat_id]);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','Category has been deleted');
    }
}

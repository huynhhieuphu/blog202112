<?php

namespace App\Http\Controllers\Admin;

use  App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Models\Category;
use App\Http\Requests\Admin\EditCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        
        // $request->validate([
        //     'name' => 'required|max:100|unique:categories',
        //     'parent_id' => 'required',
        //     'is_active' => 'required|in:0,1'
        // ]);

        $category = new Category();
        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->is_active = $request->is_active;
        $category->created_at = date('Y-m-d H:i:s');
        $category->save();
        
        // Lỗi nhỏ là khi dùng created_at và updated_at không có dữ liệu
        // Category::create([
        //     'name' => ucfirst($request->name),
        //     'slug' => Str::slug($request->name),
        //     'description' => $request->description,
        //     'parent_id' => $request->parent_id,
        //     'is_active' => $request->is_active,
        //     'created_at' => date('Y-m-d H:i:s')
        // ]);

        // return redirect()->route('admin.categories.index')->with('message', 'Inserted Successfully');
        return back()->with('message', 'Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $cate = Category::findOrFail($category);
        return view('Admin.Categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        // $request->validate([
        //     'name' => 'required|max:100|unique:categories,name,id,'. $category->id,
        //     'parent_id' => 'required',
        //     'is_active' => 'required|in:0,1'
        // ]);

        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->is_active = $request->is_active;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        // $category->update([
        //     'name' => ucfirst($request->name),
        //     'slug' => Str::slug($request->name),
        //     'description' => $request->description,
        //     'parent_id' => $request->parent_id,
        //     'is_active' => $request->is_active,
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        return back()->with('message', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'Deleted Successfully');
    }
}
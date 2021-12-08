<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateTagRequest;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\EditTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(8);
        return view('Admin.Tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name' => ucfirst($request->name),
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return back()->with('message', 'Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('Admin.Tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(EditTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => ucfirst($request->name),
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return back()->with('message', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // dd($tag->posts()->count());

        if($tag->posts()->count() == 0){
            $tag->posts()->detach();
            $tag->delete();
            return redirect()->route('admin.tags.index')->with('message', 'Deleted Successfully');
        }
        return redirect()->route('admin.tags.index')->with('message', 'Delete Failed');
    }
}

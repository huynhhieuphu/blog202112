<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use App\Http\Models\Post;
use App\Http\Requests\Admin\CreatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Models\Tag;
use App\Http\Requests\Admin\EditPostRequest;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('Admin.Post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('Admin.Post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|max:100|unique:posts',
        //     'category_id' => 'required',
        //     'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        //     'content' => 'required',
        //     'published' => 'required|boolean'
        // ]);

        if($request->has('image')){
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move('Admin/uploads/images/', $fileName);
        }

        // $post = new Post();
        // $post->title = ucfirst($request->title);
        // $post->slug = Str::slug($request->title);
        // $post->category_id = $request->category_id;
        // $post->author_id = auth()->id();
        // $post->image = $fileName;
        // $post->summary = $request->summary;
        // $post->content = $request->content;
        // $post->published = $request->published;
        // $post->created_at = now();
        // $post->save();

        $post = auth()->user()->posts()->create([
            'title' => ucfirst($request->title),
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'image' => $fileName ?? null,
            'summary' => $request->summary,
            'content' => $request->content,
            'published' => $request->published,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $tags = explode(',', $request->tags);
        $tag_ids = [];
        foreach($tags as $tag){
            $tag_db = Tag::firstOrCreate(
                ['name' => trim($tag)],
                ['slug' => Str::slug(trim($tag)),'created_at' => date('Y-m-d H:i:s')]
            );
            $tag_ids[] = $tag_db->id;
        }

        $post->tags()->attach($tag_ids);

        return back()->with('message', 'Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('Admin.Post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('Admin.Post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, Post $post)
    {
        // $request->validate([
        //     'title' => 'required|max:100|unique:posts,title,' . $post->id,
        //     'category_id' => 'required',
        //     'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        //     'content' => 'required',
        //     'published' => 'required|boolean'
        // ]);

        if($request->has('image')){
            // delete old image
            $old_img = public_path('Admin/uploads/images/' . $post->image);
            if(File::exists($old_img)){
                File::delete($old_img);
            }
            // upload new image
            $fileName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('Admin/uploads/images/', $fileName);
            $post->image = $fileName;
        }

        // $post->title = ucfirst($request->title);
        // $post->slug = Str::slug($request->title);
        // $post->category_id = $request->category_id;
        // $post->summary = $request->summary;
        // $post->content = $request->content;
        // $post->published = $request->published;
        // $post->updated_at = now();
        // $post->save();

        $post->update([
            'title' => ucfirst($request->title),
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'image' => $fileName ?? $post->image,
            'summary' => $request->summary,
            'content' => $request->content,
            'published' => $request->published,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $post->tags()->detach();

        $tags = explode(',', $request->tags);
        $tag_ids = [];
        foreach($tags as $tag){
            $tag_db = Tag::firstOrCreate(
                ['name' => trim($tag)],
                ['slug' => Str::slug(trim($tag)), 'created_at' => date('Y-m-d H:i:s')]
            );
            $tag_ids[] = $tag_db->id;
        }

        $post->tags()->attach($tag_ids);
        return back()->with('message', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $old_img = public_path('Admin/uploads/images/' . $post->image);
        if(File::exists($old_img)){
            File::delete($old_img);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Deleted Successfully');
    }
}

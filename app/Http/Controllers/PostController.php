<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['tags']       = Tag::orderBy('id', 'DESC')->get();
        $data['title'] = 'Add new post';
        return view('admin.post.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required',
            'thumbnail' => 'required|mimes:png,jpg',
            'category' => 'required',
            'tags' => 'required|array',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumb_name = time() . '.' . $thumbnail->extension();
            $thumbnail->move(public_path('upload'), $thumb_name);
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => implode('-', explode(' ', $request->title)),
            'meta_title' => $request->title,
            'thumbnail' => $thumb_name,
            'content' => $request->content,
            'excerpt' => Str::words($request->content, 10, '...'),
            'meta_description' => Str::words($request->content, 10, '...'),
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'views' => 0,
            'like' => 0,
            'publishable' => 'publish',
        ]);

        $post->tags()->sync($request->tags);

        return redirect()->route('admin.all-posts')->withSuccess('Post created successfully!');
    }

    public function index()
    {
        $data['posts'] = Post::orderBy('id', 'DESC')->get();
        $data['title'] = 'All posts';
        return view('admin.post.index',$data);
    }

    public function show(Post $post)
    {
        $data['post'] = $post;
        return view('admin.post.show',$data);
    }

    public function edit(Post $post)
    {
        $data['post'] = $post;
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['tags']       = Tag::orderBy('id', 'DESC')->get();
        $data['title'] = 'Edit post';
        return view('admin.post.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required',
            'thumbnail' => 'mimes:png,jpg',
            'category' => 'required',
            'tags' => 'required|array',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumb_name = time() . '.' . $thumbnail->extension();
            $thumbnail->move(public_path('upload'), $thumb_name);

            $old_thumbnail_path = public_path('upload/') . $post->thumbnail;

            if(\File::exists($old_thumbnail_path)) {
                \File::delete($old_thumbnail_path);
            }
        } else {
            $thumb_name = $post->thumbnail;
        }

        $post->update([
            'title' => $request->title,
            'slug' => implode('-', explode(' ', $request->title)),
            'meta_title' => $request->title,
            'thumbnail' => $thumb_name,
            'content' => $request->content,
            'excerpt' => Str::words($request->content, 10, '...'),
            'meta_description' => Str::words($request->content, 10, '...'),
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'views' => 0,
            'like' => 0,
            'publishable' => 'publish',
        ]);

        $post->tags()->sync($request->tags);
        return redirect()->route('admin.all-posts')->withSuccess('Post Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $post = Post::findOrFail($id);
        $old_thumbnail_path = public_path('upload/') . $post->thumbnail;

        if(\File::exists($old_thumbnail_path)) {
            \File::delete($old_thumbnail_path);
        }
        $post->delete();
        return redirect()->route('admin.all-posts')->withSuccess('Post successfully delete!');
    }
}

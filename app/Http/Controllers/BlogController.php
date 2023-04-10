<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data['posts'] = Post::orderBy('id', 'DESC')->paginate(5);
        $data['title'] = 'Blog posts';
        return view('blog.blog',$data);
    }

    public function single(Post $post)
    {
        $post->increment('views');
        $data['post'] = $post;
        $data['tags'] = Tag::all();
        $data['title'] = $post->title;
        return view('blog.single',$data);
    }

    public function category(Category $category)
    {
        $data['category'] = $category;
        $data['title'] = $category->name;
        $data['posts'] = $category->posts()->paginate(5);
        return view('blog.archive',$data);
    }

    public function user(User $user)
    {
        $data['user'] = $user;
        $data['title'] = $user->name;
        $data['posts'] = $user->posts()->paginate(5);
        return view('blog.author',$data);
    }
}

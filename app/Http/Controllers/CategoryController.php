<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['title'] = 'All categories';
        return view('admin.post.category.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|string|max:20',
            'thumbnail' =>  'required|mimes:png,jpg'
        ]);

        $slug = strtolower(implode('-', explode(' ', $request->name)));
        $db_category = Category::where('slug', $slug)->get()->first();
        $db_slug = isset($db_category->slug) ? $db_category->slug : '';

        if ($db_slug == $slug) {
            $slug = $slug . '-' . time();
        } else {
            $slug = strtolower(implode('-', explode(' ', $request->name)));
        }

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = time() . '.' . $thumbnail->extension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
        }

        Category::create([
            'name'      =>  $request->name,
            'slug'      =>  $slug,
            'thumbnail' =>  $thumbnail_name
        ]);

        return redirect()->back()->withSuccess('Category created successfully!');
    }

    public function edit(Category $category)
    {
        $data['category'] = $category;
        $data['title'] = 'Edit category';
        return view('admin.post.category.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'      =>  'required|string|max:20',
            'thumbnail' =>  'mimes:png,jpg'
        ]);

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = time() . '.' . $thumbnail->extension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);

            $old_thumbnail = public_path('upload/'. $category->thumbnail);

            if(\File::exists($old_thumbnail)){
                \File::delete($old_thumbnail);
            }

        } else {
            $thumbnail_name = $category->thumbnail;
        }

        $category->update([
            'name'      =>  $request->name,
            'slug'      =>  strtolower(implode('-', explode(' ', $request->name))),
            'thumbnail' =>  $thumbnail_name
        ]);

        return redirect()->route('admin.all-categories')->withSuccess('Category Updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $old_thumbnail_path = public_path() . 'upload/' . $category->thumbnail;

        if(\File::exists($old_thumbnail_path)) {
            \File::delete($old_thumbnail_path);
        }
        $category->delete();
        return redirect()->route('admin.all-categories')->withSuccess('Category successfully deleted!');
    }
}

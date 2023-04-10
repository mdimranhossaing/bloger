<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['tags'] = Tag::orderBy('id', 'DESC')->get();
        $data['title'] = 'All tags';
        return view('admin.post.tag.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|string|max:20',
        ]);

        $slug = strtolower(implode('-', explode(' ', $request->name)));
        $db_tag = Tag::where('slug', $slug)->get()->first();
        $db_slug = isset($db_tag->slug) ? $db_tag->slug : '';

        if ($db_slug == $slug) {
            $slug = $slug . '-' . time();
        } else {
            $slug = strtolower(implode('-', explode(' ', $request->name)));
        }

        Tag::create([
            'name'      =>  $request->name,
            'slug'      =>  $slug,
        ]);

        return redirect()->back()->withSuccess('Tag created successfully!');
    }

    public function edit(Tag $tag)
    {
        $data['tag'] = $tag;
        $data['title'] = 'Edit tag';
        return view('admin.post.tag.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $category = Tag::findOrFail($id);

        $request->validate([
            'name'      =>  'required|string|max:20',
        ]);

        $slug = strtolower(implode('-', explode(' ', $request->name)));
        $db_tag = Tag::where('slug', $slug)->get()->first();
        $db_slug = isset($db_tag->slug) ? $db_tag->slug : '';

        if ($db_slug == $slug) {
            $slug = $slug . '-' . time();
        } else {
            $slug = strtolower(implode('-', explode(' ', $request->name)));
        }

        $category->update([
            'name'      =>  $request->name,
            'slug'      =>  $slug,
        ]);

        return redirect()->route('admin.all-tags')->withSuccess('Tag Updated successfully!');
    }

    public function delete($id)
    {
        $category = Tag::findOrFail($id);
        $old_thumbnail_path = public_path() . 'upload/' . $category->thumbnail;

        if(\File::exists($old_thumbnail_path)) {
            \File::delete($old_thumbnail_path);
        }
        $category->delete();
        return redirect()->route('admin.all-tags')->withSuccess('Tag successfully deleted!');
    }
}

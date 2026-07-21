<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(15);
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        $baseName = Str::slug($request->name, '_');

        Tag::create([
            'name' => $request->name,
            'slug' => 'tag_' . $baseName,
        ]);

        return redirect()->route('tags.index')->with('success', 'Thêm thẻ thành công!');
    }

    public function show(Tag $tag)
    {
        $jobPosts = $tag->jobPosts()
            ->with(['company', 'category'])
            ->latest()
            ->paginate(10);

        return view('tags.show', compact('tag', 'jobPosts'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $baseName = Str::slug($request->name, '_');

        $tag->update([
            'name' => $request->name,
            'slug' => 'tag_' . $baseName,
        ]);

        return redirect()->route('tags.index')->with('success', 'Cập nhật thẻ thành công!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Xóa thẻ thành công!');
    }
}

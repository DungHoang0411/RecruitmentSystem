<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('jobPosts')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cleanName = str_ireplace('category_', '', $request->name);
        $finalName = 'category_' . ltrim($cleanName);
        $baseName = Str::slug($cleanName, '_');

        if (Category::where('name', $finalName)->exists()) {
            return back()->withErrors(['name' => 'Tên danh mục đã tồn tại.'])->withInput();
        }

        Category::create([
            'name' => $finalName,
            'slug' => 'category_' . $baseName,
        ]);

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $jobPosts = $category->jobPosts()
            ->with(['company', 'tags'])
            ->latest()
            ->paginate(10);

        return view('categories.show', compact('category', 'jobPosts'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cleanName = str_ireplace('category_', '', $request->name);
        $finalName = 'category_' . ltrim($cleanName);
        $baseName = Str::slug($cleanName, '_');

        if (Category::where('name', $finalName)->where('id', '!=', $category->id)->exists()) {
            return back()->withErrors(['name' => 'Tên danh mục đã tồn tại.'])->withInput();
        }

        $category->update([
            'name' => $finalName,
            'slug' => 'category_' . $baseName,
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->jobPosts()->delete();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}

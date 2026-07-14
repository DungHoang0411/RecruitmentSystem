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
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $baseName = Str::slug($request->name, '_');

        Category::create([
            'name' => $request->name,
            'slug' => 'category_' . $baseName,
        ]);

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function show(Category $category)
    {
        $jobPosts = $category->jobPosts()
            ->with(['company', 'tags'])
            ->latest()
            ->paginate(10);

        return view('categories.show', compact('category', 'jobPosts'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $baseName = Str::slug($request->name, '_');

        $category->update([
            'name' => $request->name,
            'slug' => 'category_' . $baseName,
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}

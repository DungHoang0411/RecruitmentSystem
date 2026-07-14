<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('jobPosts')->latest()->paginate(12);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $cleanName = str_ireplace('company_', '', $request->name);
        $finalName = 'company_' . ltrim($cleanName);
        $baseName = Str::slug($cleanName, '_');

        if (Company::where('name', $finalName)->exists()) {
            return back()->withErrors(['name' => 'Tên công ty đã tồn tại.'])->withInput();
        }

        Company::create([
            'name' => $finalName,
            'slug' => 'company_' . $baseName,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.index')->with('success', 'Thêm công ty thành công!');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        $jobPosts = $company->jobPosts()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        return view('companies.show', compact('company', 'jobPosts'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $cleanName = str_ireplace('company_', '', $request->name);
        $finalName = 'company_' . ltrim($cleanName);
        $baseName = Str::slug($cleanName, '_');

        if (Company::where('name', $finalName)->where('id', '!=', $company->id)->exists()) {
            return back()->withErrors(['name' => 'Tên công ty đã tồn tại.'])->withInput();
        }

        $company->update([
            'name' => $finalName,
            'slug' => 'company_' . $baseName,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.index')->with('success', 'Cập nhật thông tin công ty thành công!');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->jobPosts()->delete();
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Đã xóa công ty và toàn bộ tin tuyển dụng liên quan!');
    }
}

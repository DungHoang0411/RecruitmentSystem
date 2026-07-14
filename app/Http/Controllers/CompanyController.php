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
            'name' => 'required|string|max:255|unique:companies',
            'description' => 'nullable|string',
        ]);

        $baseName = Str::slug($request->name, '_');

        Company::create([
            'name' => $request->name,
            'slug' => 'company_' . $baseName,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.index')->with('success', 'Thêm công ty thành công!');
    }

    public function show(Company $company)
    {
        $jobPosts = $company->jobPosts()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        return view('companies.show', compact('company', 'jobPosts'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'description' => 'nullable|string',
        ]);

        $baseName = Str::slug($request->name, '_');

        $company->update([
            'name' => $request->name,
            'slug' => 'company_' . $baseName,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.index')->with('success', 'Cập nhật thông tin công ty thành công!');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Đã xóa công ty và toàn bộ tin tuyển dụng liên quan!');
    }
}

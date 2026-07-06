<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('destination_country')) {
            $query->where('destination_country', $request->destination_country);
        }

        if ($request->filled('visa_type')) {
            $query->where('visa_type', $request->visa_type);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobPosts = $query->orderBy('is_featured', 'desc')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('job_posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->getValidationRules(),
            ['title.unique' => 'Tiêu đề trùng lặp']
        );

        $validated['slug'] = Str::slug($request->title) . '-' . uniqid();

        $validated['created_by'] = auth()->id() ?? 1;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['view_count'] = 0;
        $validated['application_count'] = 0;

        JobPost::create($validated);

        return redirect()
            ->route('job-posts.index')
            ->with('success', 'Tạo tin tuyển dụng mới thành công!');
    }

    public function show(JobPost $jobPost)
    {
        $jobPost->increment('view_count');
        return view('job_posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        return view('job_posts.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate(
            $this->getValidationRules($jobPost->id),
            ['title.unique' => 'Tiêu đề trùng lặp']
        );

        if ($request->title !== $jobPost->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . uniqid();
        }

        $validated['is_featured'] = $request->has('is_featured');

        $jobPost->update($validated);

        return redirect()
            ->route('job-posts.index')
            ->with('success', 'Cập nhật tin tuyển dụng thành công!');
    }

    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();

        return redirect()
            ->route('job-posts.index')
            ->with('success', 'Xóa tin tuyển dụng thành công!');
    }

    protected function getValidationRules($ignoreId = null): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('job_posts', 'title')->ignore($ignoreId),
            ],
            'description' => 'required|string',
            'status' => 'required|in:draft,published,closed,expired',
            'destination_country' => 'required|string|max:255',
            'job_type' => 'required|in:full_time,part_time,contract,internship',
            'visa_type' => 'required|in:tokutei,ginou_jisshu,other',
            'headcount' => 'required|integer|min:1',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'work_location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'salary_currency' => 'nullable|string|max:10',
            'salary_period' => 'nullable|string|max:50',
            'experience_years_min' => 'nullable|integer|min:0',
            'age_min' => 'nullable|integer|min:18',
            'age_max' => 'nullable|integer|gte:age_min',
            'gender_preference' => 'nullable|in:male,female,any',
            'published_at' => 'nullable|date',
            'expired_at' => 'nullable|date|after_or_equal:published_at',
        ];
    }
}

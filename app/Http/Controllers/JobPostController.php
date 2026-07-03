<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobPosts = $query->latest()->paginate(10);

        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('job_posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destination_country' => 'required|string|max:50',
            'headcount' => 'required|integer|min:1',
            'status' => 'required|in:draft,published,closed,expired',
            'job_type' => 'required|in:full_time,part_time,contract,internship',
            'visa_type' => 'required|in:tokutei,ginou_jisshu,other',
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . time();
        $validated['created_by'] = auth()->id() ?? 1;

        JobPost::create($validated);

        return redirect()->route('job-posts.index')->with('success', 'Thêm tin tuyển dụng thành công!');
    }

    public function show(JobPost $jobPost)
    {
        return view('job_posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        return view('job_posts.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destination_country' => 'required|string|max:50',
            'headcount' => 'required|integer|min:1',
            'status' => 'required|in:draft,published,closed,expired',
            'job_type' => 'required|in:full_time,part_time,contract,internship',
            'visa_type' => 'required|in:tokutei,ginou_jisshu,other',
        ]);

        if ($jobPost->title !== $request->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . time();
        }

        $jobPost->update($validated);

        return redirect()->route('job-posts.index')->with('success', 'Cập nhật tin thành công!');
    }

    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();

        return redirect()->route('job-posts.index')->with('success', 'Xóa tin thành công!');
    }
}
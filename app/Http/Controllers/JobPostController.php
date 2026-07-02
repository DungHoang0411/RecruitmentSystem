<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Http\Requests\StoreJobPostRequest;
use App\Http\Requests\UpdateJobPostRequest;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::query();

   
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

   
        if ($request->filled('department')) {
        
            $query->where('department', 'like', '%' . $request->department . '%'); 
        }

        $jobPosts = $query->latest()->paginate(10);

        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('job_posts.create');
    }

    public function store(StoreJobPostRequest $request)
    {
        // $request->validated() sẽ lấy các dữ liệu đã vượt qua vòng kiểm tra Validation 
        JobPost::create($request->validated());
        
        return redirect()->route('job-posts.index')
                         ->with('success', 'Thêm tin tuyển dụng thành công!');
    }

    public function show(JobPost $jobPost)
    {
        return view('job_posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        return view('job_posts.edit', compact('jobPost'));
    }

    public function update(UpdateJobPostRequest $request, JobPost $jobPost)
    {
        $jobPost->update($request->validated());
        
        return redirect()->route('job-posts.index')
                         ->with('success', 'Cập nhật tin tuyển dụng thành công!');
    }

    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();
        
        return redirect()->route('job-posts.index')
                         ->with('success', 'Xóa tin tuyển dụng thành công!');
    }
}
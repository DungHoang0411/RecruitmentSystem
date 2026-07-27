<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class JobController extends Controller
{
    public function show($id)
    {
        $job = Cache::remember("job:{$id}", now()->addHours(24), function () use ($id) {
            return Job::findOrFail($id);
        });

        return view('jobs.show', compact('job'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $job = Job::findOrFail($id);

                $job->update($request->only(['title', 'description', 'status']));

                if ($request->has('skills')) {
                    $job->skills()->sync($request->input('skills'));
                }
            });

            return redirect()->route('jobs.show', $id)->with('success', 'Cập nhật thành công');

        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi hệ thống, đã rollback dữ liệu')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $job = Job::findOrFail($id);
                $job->delete();
            });

            return redirect()->route('jobs.index')->with('success', 'Xóa thành công');

        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi hệ thống');
        }
    }
}

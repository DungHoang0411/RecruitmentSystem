<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportLog;
use App\Jobs\ProcessJobPostExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportJobPosts(Request $request)
    {
        $log = ExportLog::create([
            'user_id' => Auth::id(),
            'filters' => json_encode($request->all()), // Lưu lại toàn bộ bộ lọc
            'status' => 'pending',
        ]);

        ProcessJobPostExport::dispatch($log->id, $request->all());
        return redirect()->route('exports.history')
            ->with('success', 'Yêu cầu xuất dữ liệu đã được đưa vào hàng đợi. Hệ thống đang xử lý ngầm!');
    }

    public function history()
    {
        $logs = ExportLog::where('user_id', Auth::id())->latest()->paginate(10);

        return view('exports.history', compact('logs'));
    }

    public function download($id)
    {
        $log = ExportLog::where('user_id', Auth::id())->findOrFail($id);

        if ($log->status !== 'completed' || !$log->file_name) {
            return back()->with('error', 'File chưa sẵn sàng hoặc quá trình xuất đã bị lỗi.');
        }

        $filePath = 'exports/' . $log->file_name;

        if (!Storage::disk('public')->exists($filePath)) {
            return back()->with('error', 'Không tìm thấy file trên hệ thống. File có thể đã bị xóa.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function checkStatus()
    {
        $logs = ExportLog::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get(['id', 'status', 'error_message']);

        return response()->json($logs);
    }
}

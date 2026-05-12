<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(50);

        $stats = [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', today())->count(),
            'creates' => ActivityLog::where('action', 'Create')->count(),
            'updates' => ActivityLog::where('action', 'Update')->count(),
            'deletes' => ActivityLog::where('action', 'Delete')->count(),
            'logins' => ActivityLog::where('action', 'Login')->count(),
        ];

        return view('admin.activity-log', compact('logs', 'stats'));
    }
}

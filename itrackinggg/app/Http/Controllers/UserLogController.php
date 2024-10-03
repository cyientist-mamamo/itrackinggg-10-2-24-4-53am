<?php

namespace App\Http\Controllers;
use App\Models\UserLog;

class UserLogController extends Controller
{
    public function index()
    {
        $logs = UserLog::with('user')->latest()->paginate(10); // Assuming there's a user relationship defined
        return view('user_logs.index', compact('logs'));
    }
}

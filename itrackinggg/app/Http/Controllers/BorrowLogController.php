<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use App\Models\BorrowLog;
use Illuminate\Http\Request;

class BorrowLogController extends Controller
{
    public function index()
    {
        $borrowLogs = BorrowLog::with('equipment')->get(); // Eager load the equipment relationship
        return view('borrow_logs.index', compact('borrowLogs'));
    }
    public function return($id)
    {
        // Find the borrow log
        $borrowLog = BorrowLog::findOrFail($id);
        
        // Update the related equipment's status to 'usable'
        $equipment = Equipment::findOrFail($borrowLog->equipment_id);
        $equipment->status = 'usable';
        $equipment->save();

        // Optionally, you could also update the date_returned in the borrow log
        $borrowLog->date_returned = now(); // Set to current date/time
        $borrowLog->save();

        return redirect()->route('borrowlogs.index')->with('success', 'Equipment marked as returned successfully.');
    }
}

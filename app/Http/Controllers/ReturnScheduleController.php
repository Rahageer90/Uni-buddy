<?php

namespace App\Http\Controllers;

use App\Models\ReturnSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnScheduleController extends Controller
{
    public function index()
    {
        $schedules = ReturnSchedule::with('user')
            ->where('studentID', Auth::id())
            ->get();
            
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sun' => 'nullable|date_format:H:i',
            'mon' => 'nullable|date_format:H:i',
            'tue' => 'nullable|date_format:H:i',
            'wed' => 'nullable|date_format:H:i',
            'thu' => 'nullable|date_format:H:i',
            'fri' => 'nullable|date_format:H:i',
            'sat' => 'nullable|date_format:H:i',
            'toDest' => 'required|string|max:100',
            'prefVehicle' => 'required|string|max:50',
        ]);

        $validated['studentID'] = Auth::id();

        ReturnSchedule::create($validated);

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit($id)
    {
        $schedule = ReturnSchedule::where('id', $id)
            ->where('studentID', Auth::id())
            ->firstOrFail();

        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = ReturnSchedule::where('id', $id)
            ->where('studentID', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'sun' => 'nullable|date_format:H:i',
            'mon' => 'nullable|date_format:H:i',
            'tue' => 'nullable|date_format:H:i',
            'wed' => 'nullable|date_format:H:i',
            'thu' => 'nullable|date_format:H:i',
            'fri' => 'nullable|date_format:H:i',
            'sat' => 'nullable|date_format:H:i',
            'toDest' => 'required|string|max:100',
            'prefVehicle' => 'required|string|max:50',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = ReturnSchedule::where('id', $id)
            ->where('studentID', Auth::id())
            ->firstOrFail();

        $schedule->delete();

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule deleted successfully.');
    }

    public function search(Request $request)
    {
        $day = strtolower(now()->format('D')); // mon, tue, etc.
        $currentTime = now()->format('H:i:s');
        
        // Get schedules that match the current day and time (±1 hour)
        $matchingSchedules = ReturnSchedule::with('user')
            ->where('studentID', '!=', Auth::id())
            ->whereNotNull($day)
            ->where($day, '>=', date('H:i:s', strtotime('-1 hour', strtotime($currentTime))))
            ->where($day, '<=', date('H:i:s', strtotime('+1 hour', strtotime($currentTime))))
            ->get();

        return view('schedule.search', compact('matchingSchedules', 'day'));
    }
}

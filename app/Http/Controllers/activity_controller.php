<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Seeker;

class activity_controller extends Controller
{
    public function uploadActivity(Request $request)
    {
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'activity_time' => 'required',
            'slot' => 'required|integer|min:1',
            'open_reg_date' => 'required|date',
            'close_reg_date' => 'required|date',
            'requirements' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'proposal' => 'nullable|mimes:pdf|max:10240',
        ]);


        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        $currentUserId = $request->session()->get('user')->id;
        $currentSeekerId = Seeker::firstWhere('user_id', '=', $currentUserId)->id;

        Activity::create([
            'activity_name' => $validated['activity_name'],
            'activity_date' => $validated['activity_date'],
            'activity_time' => $validated['activity_time'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'open_reg_date' => $validated['open_reg_date'],
            'close_reg_date' => $validated['close_reg_date'],
            'image_path' => $imagePath,
            'slot' => $validated['slot'],
            'seeker_id' => $currentSeekerId,
        ]);

        return redirect('/proposed-activities')->with('success', 'Activity uploaded successfully!');
    }

    public function deleteActivity($id)
    {
        $activity = Activity::withCount('volunteers')->findOrFail($id);

        if ($activity->volunteers_count > 0) {
            return redirect('/proposed-activities')
                ->with('error', 'Activity cannot be deleted because at least one volunteer has joined.');
        }

        $activity->delete();

        return redirect('/proposed-activities')
            ->with('success', 'Activity deleted successfully!');
    }

    public function markDoneActivity($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->is_done = true;
        $activity->save();

        return redirect('/proposed-activities')->with('success', 'Activity marked as done!');
    }
}
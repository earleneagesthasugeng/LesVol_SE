<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
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

            'activity_date' => 'required|date|after:today',
            'activity_time' => 'required',

            'slot' => 'required|integer|min:1',

            'open_reg_date' => 'required|date',
            'close_reg_date' => 'required|date|after:open_reg_date|before:activity_date',

            'requirements' => 'nullable|string',
            'description' => 'nullable|string',

            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'proposal' => 'nullable|mimes:pdf|max:10240',
        ], [
            'activity_date.after' => 'Activity date must be after today.',
            'close_reg_date.after' => 'Close registration date must be after open registration date.',
            'close_reg_date.before' => 'Close registration date must be before the activity date.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, or PNG format.',
            'image.max' => 'Image size must not be larger than 2MB.',
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

    public function uploadAttendance(Request $request, $id)
    {
        $request->validate([
            'attendance_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $currentUserId = $request->session()->get('user')->id;

        $volunteer = Volunteer::where('activity_id', $id)
            ->where('user_id', $currentUserId)
            ->firstOrFail();

        if ($volunteer->is_banned) {
            return redirect()->back()->with('error', 'You cannot upload attendance because you have been banned from this activity.');
        }

        $activity = Activity::findOrFail($id);

        if (!$activity->is_done) {
            return redirect()->back()->with('error', 'Attendance can only be uploaded after the activity is marked as done.');
        }

        if ($request->hasFile('attendance_photo')) {
            $path = $request->file('attendance_photo')->store('attendance_proofs', 'public');
            $volunteer->file_att_path = $path;
            $volunteer->save();
        }

        return redirect()->back()->with('success', 'Attendance proof uploaded successfully!');
    }

    public function updateDescription(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:5000',
        ]);

        $currentUserId = $request->session()->get('user')->id;
        $currentSeeker = Seeker::where('user_id', $currentUserId)->firstOrFail();

        $activity = Activity::where('id', $id)
            ->where('seeker_id', $currentSeeker->id)
            ->firstOrFail();

        $activity->description = $validated['description'];
        $activity->save();

        return redirect('/options/' . $id)->with('success', 'Description updated successfully!');
    }

    public function toggleBan($id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $volunteer->is_banned = !$volunteer->is_banned;
        $volunteer->save();

        return redirect()->back()->with('success', 'Volunteer status updated successfully!');
    }

    public function showMyActivities(Request $request)
    {
        $search = $request->input('search');
        $currentUserId = $request->session()->get('user')->id;

       
        $currentSeeker = Seeker::where('user_id', $currentUserId)->first();
        $isSeeker = !is_null($currentSeeker);

     
        $activities = Volunteer::where('user_id', $currentUserId)
            ->with('activity')
            ->whereHas('activity', function($query) use ($search) {
                if ($search) {
                    $query->where('activity_name', 'like', '%' . $search . '%');
                }
            })
            ->get()
            ->pluck('activity'); // Kita ambil object activity-nya saja agar loop di blade tidak error

        return view('my-activities', compact('activities', 'isSeeker'));
    }

    public function showProposed(Request $request)
    {
        $search = $request->input('search');
        $currentUserId = $request->session()->get('user')->id;
        $currentSeeker = Seeker::where('user_id', $currentUserId)->first();
        $isSeeker = !is_null($currentSeeker);

        $activities = Activity::where('seeker_id', $currentSeeker->id)
            ->where('is_done', false)
            ->when($search, function($query) use ($search) {
                return $query->where('activity_name', 'like', '%' . $search . '%');
            })->get();

        return view('proposed-activities', compact('activities', 'isSeeker'));
    }

  
    public function showDone(Request $request)
    {
        $search = $request->input('search');
        $currentUserId = $request->session()->get('user')->id; // Ambil ID user yang sedang login
        $currentSeeker = Seeker::where('user_id', $currentUserId)->first();
        $isSeeker = !is_null($currentSeeker);

        $activities = Activity::where('seeker_id', $currentSeeker->id)
            ->where('is_done', true)
            ->when($search, function($query) use ($search) {
                return $query->where('activity_name', 'like', '%' . $search . '%');
            })->get();

        // Kirim $currentUserId ke view agar tidak error
        return view('done-activity', compact('activities', 'isSeeker', 'currentUserId'));
    }
}
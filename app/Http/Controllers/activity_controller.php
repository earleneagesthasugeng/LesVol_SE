<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Seeker;
use App\Models\Volunteer;

class activity_controller extends Controller
{
    public function uploadActivity(Request $request){
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

     public function deleteActivity(Request $request, $id)
     {
         $activity = Activity::findOrFail($id);

         // Guard: prevent deletion if volunteers have joined
         $volunteersCount = Volunteer::where('activity_id', $id)->count();
         if ($volunteersCount > 0) {
             return redirect()->back()->with('error', 'Cannot delete: volunteers have already joined this activity.');
         }

         $activity->delete();
         return redirect('/proposed-activities')->with('success', 'Activity deleted successfully!');
     }

    /**
     * Toggle the is_banned status of a volunteer.
     */
    public function toggleBan(Request $request, $volunteer_id)
    {
        $volunteer = Volunteer::findOrFail($volunteer_id);

        $volunteer->is_banned = !$volunteer->is_banned;
        $volunteer->save();

        $status = $volunteer->is_banned ? 'banned' : 'unbanned';
        return redirect()->back()->with('success', "Volunteer has been {$status}.");
    }

    /**
     * Handle proof-of-attendance upload from a volunteer.
     */
    public function submitProof(Request $request, $activity_id)
    {
        $currentUser = $request->session()->get('user');
        if (!$currentUser) {
            return redirect('/login');
        }

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        $volunteer = Volunteer::where('activity_id', $activity_id)
            ->where('user_id', $currentUser->id)
            ->firstOrFail();

        $proofPath = $request->file('proof')->store('proofs', 'public');
        $volunteer->proof_path = $proofPath;
        $volunteer->save();

        return redirect()->back()->with('success', 'Proof uploaded successfully!');
    }

    /**
     * Transition an activity's status to "done".
     * Only the seeker who owns the activity can do this.
     */
    public function markDone(Request $request, $activity_id)
    {
        $currentUser = $request->session()->get('user');
        if (!$currentUser) {
            return redirect('/login');
        }

        $activity = Activity::findOrFail($activity_id);

        // Verify that the current user is the seeker who owns this activity
        $seeker = Seeker::firstWhere('user_id', $currentUser->id);
        if (!$seeker || $activity->seeker_id !== $seeker->id) {
            return redirect()->back()->with('error', 'You are not authorized to mark this activity as done.');
        }

        $activity->status = 'done';
        $activity->save();

        return redirect('/done-activity')->with('success', 'Activity has been marked as done!');
    }
}

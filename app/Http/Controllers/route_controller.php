<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Activity;
use App\Models\Seeker;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class route_controller extends Controller
{
    public function homePage(Request $request)
    {
        $currentUser = $request->session()->get('user');

        if (!$currentUser) {
            return redirect('/login');
        }

        $currentUserId = $currentUser->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        if (!$isSeeker) {
            $activities = Activity::where('slot', '>', 0)
                ->orderBy('activity_date', 'asc')
                ->get();
        } else {
            $currentSeekerId = $isSeeker->id;

            $activities = Activity::where('seeker_id', '!=', $currentSeekerId)
                ->where('slot', '>', 0)
                ->orderBy('activity_date', 'asc')
                ->get();
        }

        return view('home', compact('activities', 'isSeeker'));
    }

    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('register');
    }

    public function updateProfile(Request $request)
    {
        $currentUser = $request->session()->get('user');

        if (!$currentUser) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $currentUser->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($currentUser->id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $request->session()->put('user', $user);

        return redirect('/profile')->with('success', 'Profile updated successfully.');
    }

    public function uploadActivityPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        return view('upload-activity', compact('isSeeker'));
    }

    public function activityPage()
    {
        return view('activity');
    }

    public function beASeekerPage()
    {
        return view('be-a-seeker');
    }

    public function doneActivityPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        // Fetch activities with status 'done' where the current user is a volunteer
        $doneActivities = Activity::where('status', 'done')
            ->whereHas('volunteers', function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId);
            })
            ->get();

        // Also fetch activities proposed by this seeker that are marked done
        $proposedDoneActivities = collect();
        if ($isSeeker) {
            $proposedDoneActivities = Activity::where('status', 'done')
                ->where('seeker_id', $isSeeker->id)
                ->get();
        }

        // Merge both, remove duplicates
        $activities = $doneActivities->merge($proposedDoneActivities)->unique('id');

        return view('done-activity', compact('isSeeker', 'activities'));
    }

    public function myActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activities = Activity::whereHas('volunteers', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })->get();

        return view('my-activities', compact('isSeeker', 'activities'));
    }

    public function optionsPage(Request $request, $id)
    {
        $activity = Activity::with('seeker.user')->findOrFail($id);
        $volunteersCount = Volunteer::where('activity_id', $id)->count();

        return view('options', compact('activity', 'volunteersCount'));
    }

    public function participantsPage(Request $request, $activity_id)
    {
        $activity = Activity::findOrFail($activity_id);
        $volunteers = Volunteer::with('user')
            ->where('activity_id', $activity_id)
            ->get();
        $volunteersCount = $volunteers->count();

        return view('participants', compact('activity', 'volunteers', 'volunteersCount'));
    }

    public function profileUserPage()
    {
        return view('profile-user');
    }

    public function profilePage(Request $request)
    {
        $user = $request->session()->get('user');
        return view('profile', compact('user'));
    }

    public function proposedActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $currentSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        if (!$currentSeeker) {
            return redirect('/')->with('error', 'You are not registered as a seeker.');
        }

        $activities = Activity::where('seeker_id', '=', $currentSeeker->id)->get();

        return view('proposed-activities', compact('activities'));
    }

    public function registerActivityPage(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $currentUserId = $request->session()->get('user')->id;
        $user = User::firstWhere('id', '=', $currentUserId);

        return view('register-activity', compact('activity', 'user'));
    }

    public function submitRegisterActivity(Request $request, $id)
    {
        $currentUser = $request->session()->get('user');

        if (!$currentUser) {
            return redirect('/login');
        }

        $currentUserId = $currentUser->id;

        $currentSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        try {
            DB::transaction(function () use ($id, $currentUserId, $currentSeeker) {
                $activity = Activity::lockForUpdate()->findOrFail($id);

                if ($activity->slot <= 0) {
                    throw new \Exception('Sorry, this activity is full.');
                }

                if ($currentSeeker && $activity->seeker_id == $currentSeeker->id) {
                    throw new \Exception('You cannot join your own activity.');
                }

                $existingVolunteer = Volunteer::where('user_id', $currentUserId)
                    ->where('activity_id', $id)
                    ->first();

                if ($existingVolunteer) {
                    throw new \Exception('You are already registered for this activity.');
                }

                Volunteer::create([
                    'is_banned' => 0,
                    'file_att_path' => null,
                    'user_id' => $currentUserId,
                    'activity_id' => $id,
                ]);

                $activity->slot = $activity->slot - 1;
                $activity->save();
            });

            return redirect()->back()->with('success', 'You are successfully registered!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function seeDetailsDonePage(Request $request, $id)
    {
        $currentUserId = $request->session()->get('user')->id;
        $activity = Activity::with('seeker.user')->findOrFail($id);

        // Check if the current user is a volunteer for this activity
        $volunteer = Volunteer::where('activity_id', $id)
            ->where('user_id', $currentUserId)
            ->first();

        // Check if the current user is the seeker/owner
        $isSeeker = Seeker::firstWhere('user_id', $currentUserId);
        $isOwner = $isSeeker && $activity->seeker_id === $isSeeker->id;

        return view('see-details-done', compact('activity', 'volunteer', 'isOwner'));
    }

    public function seeDetailsPage($id, Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activity = Activity::with('seeker.user')->findOrFail($id);

        $isJoined = Volunteer::where('activity_id', $id)
            ->where('user_id', $currentUserId)
            ->exists();

        return view('see-details', compact('activity', 'isSeeker', 'isJoined'));
    }

    public function editProfilePage()
    {
        return view('edit-profile');
    }

    public function editPortfolioPage()
    {
        return view('edit-portfolio');
    }

    public function viewPortfolioPage()
    {
        return view('view-portfolio');
    }

    public function myPortfolioPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;

        // Fetch all 'done' activities where the user was a volunteer and submitted proof
        $portfolioItems = Volunteer::with('activity')
            ->where('user_id', $currentUserId)
            ->whereNotNull('proof_path')
            ->whereHas('activity', function ($query) {
                $query->where('status', 'done');
            })
            ->get();

        return view('my-portfolio', compact('portfolioItems'));
    }
}
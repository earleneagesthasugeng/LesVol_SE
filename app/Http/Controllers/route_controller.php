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

    public function activityPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('activity', compact('isSeeker'));
    }

    public function beASeekerPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('be-a-seeker', compact('isSeeker'));
    }

    public function doneActivityPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activities = Activity::with(['volunteers' => function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId);
            }])
            ->where('is_done', true)
            ->where(function ($query) use ($currentUserId, $isSeeker) {
                $query->whereHas('volunteers', function ($q) use ($currentUserId) {
                    $q->where('user_id', $currentUserId);
                });
                if ($isSeeker) {
                    $query->orWhere('seeker_id', $isSeeker->id);
                }
            })->get();

        return view('done-activity', compact('isSeeker', 'activities', 'currentUserId'));
    }

    public function myActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activities = Activity::whereHas('volunteers', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })
        ->where('is_done', false)
        ->get();

        return view('my-activities', compact('isSeeker', 'activities'));
    }

    public function optionsPage(Request $request, $id)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        $activity = Activity::with('seeker.user')->findOrFail($id);
        $volunteersCount = Volunteer::where('activity_id', $id)->count();

        return view('options', compact('activity', 'volunteersCount', 'isSeeker'));
    }

  public function participantsPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        $activityId = $request->query('activity_id');

        if (!$activityId) {
            return redirect('/proposed-activities')->with('error', 'Activity not found.');
        }

        $activity = Activity::findOrFail($activityId);

        $volunteers = Volunteer::with('user')
            ->where('activity_id', $activityId)
            ->get();

        $volunteersCount = $volunteers->count();

        return view('participants', compact('activity', 'volunteers', 'volunteersCount', 'isSeeker'));
    }

    public function profileUserPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('profile-user', compact('isSeeker'));
    }

    public function profilePage(Request $request, $id = null)
    {
        $currentUser = $request->session()->get('user');

        if (!$currentUser) {
            return redirect('/login');
        }

        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUser->id);

        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = User::findOrFail($currentUser->id);
        }

        $isOwnProfile = $currentUser->id == $user->id;

        $backUrl = '/home';

        if ($request->query('back') === 'participants' && $request->query('activity_id')) {
            $backUrl = '/participants?activity_id=' . $request->query('activity_id');
        }

        return view('profile', compact('user', 'isOwnProfile', 'backUrl', 'isSeeker'));
    }

    public function proposedActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        if (!$isSeeker) {
            return redirect('/')->with('error', 'You are not registered as a seeker.');
        }

        $activities = Activity::where('seeker_id', '=', $isSeeker->id)
            ->where('is_done', false)
            ->get();

        return view('proposed-activities', compact('activities', 'isSeeker'));
    }

    public function registerActivityPage(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        $user = User::firstWhere('id', '=', $currentUserId);

        return view('register-activity', compact('activity', 'user', 'isSeeker'));
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

                if ($activity->is_done) {
                    throw new \Exception('Sorry, this activity has already been completed.');
                }

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
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activity = Activity::with('seeker.user')->findOrFail($id);

        $volunteer = Volunteer::where('activity_id', $id)
            ->where('user_id', $currentUserId)
            ->first();

        $isJoined = $volunteer !== null;

        return view('see-details-done', compact('activity', 'isSeeker', 'isJoined', 'volunteer'));
    }

    public function seeDetailsPage($id, Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        $activity = Activity::with('seeker.user')->findOrFail($id);

        $volunteer = Volunteer::where('activity_id', $id)
            ->where('user_id', $currentUserId)
            ->first();

        $isJoined = $volunteer !== null;

        return view('see-details', compact('activity', 'isSeeker', 'isJoined', 'volunteer'));
    }

    public function editProfilePage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('edit-profile', compact('isSeeker'));
    }

    public function editPortfolioPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('edit-portfolio', compact('isSeeker'));
    }

    public function viewPortfolioPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('view-portfolio', compact('isSeeker'));
    }

    public function myPortfolioPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('my-portfolio', compact('isSeeker'));
    }
}
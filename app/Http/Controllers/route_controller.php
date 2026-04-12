<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Seeker;
use App\Models\Activity;
use App\Models\Volunteer;


class route_controller extends Controller
{
    public function loginPage()
    {
        return view('login');
    }


    public function registerPage()
    {
        return view('register');
    }


   public function homePage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        if(!$isSeeker){
             $activities = Activity::all();
        }
        else {
             $currentSeekerId = $isSeeker->id;
            $activities = Activity::where('seeker_id','!=',$currentSeekerId)->get();
        }
        return view('home', compact('activities', 'isSeeker'));
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

        return view('done-activity', compact('isSeeker'));
    }


    public function myActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);

        // Ambil semua activity yang diikuti user saat ini
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


    public function participantsPage()
    {
        return view('participants');
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
        $currentSeekerId = Seeker::firstWhere('user_id', '=', $currentUserId)->id;
        $activities = Activity::where('seeker_id', '=', $currentSeekerId)->get();
        return view('proposed-activities', compact('activities'));
    }


    public function registerActivityPage(Request $request, $id)
    {
        $activity=Activity::firstWhere('id','=',$id);

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

        $activity = Activity::findOrFail($id);
        $currentUserId = $currentUser->id;

        // Check if slots are available
        if ($activity->slot <= 0) {
            return redirect()->back()->with('error', 'Sorry, this activity is full.');
        }

        // Check if user is the seeker (owner) of the activity
        $currentSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        if ($currentSeeker && $activity->seeker_id == $currentSeeker->id) {
            return redirect()->back()->with('error', 'You cannot join your own activity.');
        }

        // Prevent duplicate registration
        $existingVolunteer = Volunteer::where('user_id', $currentUserId)
            ->where('activity_id', $id)
            ->first();

        if (!$existingVolunteer) {
            Volunteer::create([
                'is_banned' => 0,
                'file_att_path' => null,
                'user_id' => $currentUserId,
                'activity_id' => $id,
            ]);

            // Decrement the slot
            $activity->decrement('slot');
        } else {
            return redirect()->back()->with('error', 'You are already registered for this activity.');
        }

        return redirect()->back()->with('success', 'You are successfully registered!');
    }
    public function seeDetailsDonePage()
    {
        return view('see-details-done');
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

    public function myPortfolioPage()
    {
        return view('my-portfolio');
    }

}
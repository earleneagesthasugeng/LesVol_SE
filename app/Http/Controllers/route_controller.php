<?php


namespace App\Http\Controllers;


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


   public function homePage()
    {
        $activities = Activity::all();
        return view('home', compact('activities'));
    }


    public function uploadActivityPage()
    {
        return view('upload-activity');
    }


    public function activityPage()
    {
        return view('activity');
    }


    public function beASeekerPage()
    {
        return view('be-a-seeker');
    }


    public function doneActivityPage()
    {
        return view('done-activity');
    }


    public function myActivitiesPage()
    {
        return view('my-activities');
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


    public function registerActivityPage()
    {
        return view('register-activity');
    }


    public function seeDetailsDonePage()
    {
        return view('see-details-done');
    }


    public function seeDetailsPage()
    {
        return view('see-details');
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




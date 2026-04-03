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


    public function myActivitiesPage(Request $request)
    {
        $currentUserId = $request->session()->get('user')->id;
        $isSeeker = Seeker::firstWhere('user_id', '=', $currentUserId);
        return view('my-activities', compact('isSeeker'));
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
        return view('register-activity', compact('activity'));
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




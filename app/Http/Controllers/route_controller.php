<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


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
        return view('home');
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


    public function optionsPage()
    {
        return view('options');
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


    public function proposedActivitiesPage()
    {
        return view('proposed-activities');
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




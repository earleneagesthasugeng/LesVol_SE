<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seeker;

class seeker_controller extends Controller
{
    public function registerSeeker(Request $request){
        
        $request->validate([
            'identity_card' => 'required|image|mimes:png,jpg,jpeg|max:10240',
        ]);

        if ($request->hasFile('identity_card')) {
            $file = $request->file('identity_card');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ktp', $filename, 'public');

            Seeker::create([
                'file_ktp_path'=> $path,
                'user_id'=> $request->session()->get('user')->id
            ]);

            return redirect('/be-a-seeker')->with('success', 'Welcome Seeker!');
        }
    }
}

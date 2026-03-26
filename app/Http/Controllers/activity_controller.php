<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

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
        ]);


        return redirect('/proposed-activities')->with('success', 'Activity uploaded successfully!');
    }
}

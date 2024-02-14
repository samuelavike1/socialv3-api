<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'avatar_path' => 'required|string',
            'date_of_birth' => 'required|date',
            'city' => 'required|string',
            'country' => 'required|string',
            'bio' => 'required|string',
        ]);

        $save_profile = $request->user()->userprofile()->create($validated);

        $result = ($save_profile)? ['message'=>'Success', $save_profile,]: ['message'=>'failed'];

        return response()->json($result);
    }


    public function show()
    {
        $user = auth()->user();
        //$user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Access the user's profile through the relationship method
            $profile = $user->userprofile;

            if ($profile) {
                // Profile exists, return it
                return response()->json($profile);
            } else {
                // Profile does not exist for the user
                return response()->json(['message' => 'User profile not found'], 404);
            }
        } else {
            // User is not authenticated
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'avatar_path' => 'required|string',
            'date_of_birth' => 'required|date',
            'city' => 'required|string',
            'country' => 'required|string',
            'bio' => 'required|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Retrieve the user's profile
        $profile = $user->userprofile;

        // Check if the user has a profile
        if (!$profile) {
            return response()->json(['message' => 'User profile not found'], 404);
        }

        // Update the profile fields
        $profile->update($request->all());

        // Return a success response
        return response()->json(['message' => 'Profile updated successfully']);

    }


}

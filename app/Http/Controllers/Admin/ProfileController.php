<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "name" => "required|max:255",
            "email" => [
                "required",
                "string",
                "lowercase",
                "email",
                "max:256",
                Rule::unique('users')->ignore($user->id),
            ],
            "bio" => "nullable|string|max:1000",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->hasFile('image')) {
            $oldImage = public_path('uploads/images/' . $user->image);
            if ($user->image && file_exists($oldImage)) {
                @unlink($oldImage);
            }

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $fileName);
            $user->image = $fileName;
        }

        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "current_password" => "required",
            "password" => ["required", "confirmed", Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Password updated successfully!');
    }
}
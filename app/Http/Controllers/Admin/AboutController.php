<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::latest()->first();
        return view('admin.abouts.edit', compact(['about']));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',

            'home_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $about = About::latest()->first();
        $about->name = $request->name;
        $about->greeting = $request->greeting;
        $about->role = $request->role;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->address = $request->address;
        $about->description = $request->description;
        $about->summary = $request->summary;
        $about->tagline = $request->tagline;
        $about->availability_text = $request->availability_text;

        // uploading home_image
        if ($request->hasFile('home_image')) {
            $oldImage = public_path('uploads/images/' . $about->home_image);
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $file_name = Str::uuid() . '.' . $request->home_image->getClientOriginalExtension();
            $request->home_image->move(public_path('uploads/images'), $file_name);
            $about->home_image = $file_name;
        }

        // uploading banner_image
        if ($request->hasFile('banner_image')) {
            $oldBanner = public_path('uploads/images/' . $about->banner_image);
            if (file_exists($oldBanner)) {
                @unlink($oldBanner);
            }
            $filename = Str::uuid() . '.' . $request->banner_image->getClientOriginalExtension();
            $request->banner_image->move(public_path('uploads/images'), $filename);
            $about->banner_image = $filename;
        }

        // uploading cv
        if ($request->hasFile('cv')) {
            $oldCv = public_path('uploads/cv/' . $about->cv);
            if (file_exists($oldCv)) {
                @unlink($oldCv);
            }
            $file = 'resume.' . $request->cv->getClientOriginalExtension();
            $request->cv->move(public_path('uploads/cv'), $file);
            $about->cv = $file;
        }

        $about->save();
        return redirect()->route('abouts.edit')->with('success', 'About Me information Updated Successfully!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function index(){

        $testimonials = Testimonial::orderBy('id', 'DESC')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "function" => "required",
            "testimony" => "required",
            "rating" => "required|integer|min:1|max:5",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->function = $request->function;
        $testimonial->testimony = $request->testimony;
        $testimonial->rating = $request->rating;

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $file_name);
            $testimonial->image = $file_name;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created Successfully !');
    }


    public function edit($id){
        $testimonial = Testimonial::find($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "function" => "required",
            "testimony" => "required",
            "rating" => "required|integer|min:1|max:5",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        $testimonial = Testimonial::find($id);

        $testimonial->name = $request->name;
        $testimonial->function = $request->function;
        $testimonial->testimony = $request->testimony;
        $testimonial->rating = $request->rating;

        if ($request->hasFile('image')) {
            $image = public_path('uploads/images/' . $testimonial->image);
            if (file_exists($image)) {
                @unlink($image);
            }
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $file_name);
            $testimonial->image = $file_name;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated Successfully !');
    }


    public function destroy($id){
        $testimonial = Testimonial::find($id);
        $image = public_path() . "uploads/images/" . $testimonial->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('flash_message', 'Testimonial Deleted Successfully !');
    }
}

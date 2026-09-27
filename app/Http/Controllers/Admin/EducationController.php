<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('id', 'DESC')->paginate(10);
        return view('admin.educations.index', compact('educations'));
    }


    public function store(Request $request)
    {
        $request->validate([
            "institution" => "required",
            "period" => "required",
        ]);

        $education = new Education();

        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->department = $request->department;
        $education->description = $request->description;
        $education->save();

        return redirect()->route('admin.educations.index')->with('success', 'Eduction has been Added Successfully!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "institution" => "required",
            "period" => "required",
        ]);

        $education = Education::find($id);
       
        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->department = $request->department;
        $education->description = $request->description;
        $education->save();

        return redirect()->route('admin.educations.index')->with('success', 'Eduction has been Updated Successfully!');
    }

    public function destroy($id){

        $education = Education::find($id);
        $education->delete();

        return redirect()->route('admin.educations.index')->with('success', 'Eduction Deleted Successfully!');
    }
}

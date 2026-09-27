<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::orderBy('id', 'DESC')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create(){
        return view('admin.projects.create');
    }

    public function store(Request $request){

        $request->validate([
            "title" => "required",
            "description" => "required",
            "image" => "nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048",
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->category = $request->category;
        $project->description = $request->description;
        $project->technologies = $request->technologies;
        $project->link = $request->link;

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $file_name);
            $project->image = $file_name;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project has been created Successfully!');
    }

    public function edit($id){
       $project = Project::find($id);
       return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "image" => "nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048",
        ]);

        $project = Project::find($id);

        $project->title = $request->title;
        $project->category = $request->category;
        $project->description = $request->description;
        $project->technologies = $request->technologies;
        $project->link = $request->link;

        if ($request->hasFile('image')) {
            $image = public_path('uploads/images/' . $project->image);
            if (file_exists($image)) {
                @unlink($image);
            }
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $file_name);
            $project->image = $file_name;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project has been updated Successfully!');
    }

    public function destroy($id){
        $project = Project::find($id);
        $project -> delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project has been deleted Successfully!');
    }
}
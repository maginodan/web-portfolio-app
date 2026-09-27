<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class SkillController extends Controller
{
    public function index(Request $request)
    {   
        $keyword = $request->get('search');
        $perPage = 10;
        $services = Service::all();

        if (!empty($keyword)) {
            $skills = Skill::where('name','LIKE',"%$keyword%")
               ->orderBy('id', 'DESC')->paginate($perPage);
        } else {
            $skills = Skill::with('service')->orderBy('id', 'DESC')->paginate($perPage);
            // $services = Service::all();
        }  
        return view('admin.skills.index', compact(['skills', 'services']))->with('1', (request()->input('page', 1) - 1) * 2);
    }

    public function store(Request $request)
    {    
         $request->validate([
            'name' => 'required',
            'proficiency' => 'required',
         ]);
         $skill = new Skill;
         $skill ->name = $request->name;
         $skill->proficiency = $request->proficiency;
         $skill->service_id = $request->service_id;
         $skill->save();

         return redirect()->route('admin.skills.index')->with('success', 'Skill has been Added Successfully!');

    }

    public function update(Request $request, $id){
         
         $request->validate([
            'name' => 'required',
            'proficiency' => 'required',
         ]);
         $skill = Skill::find($id);
         $skill ->name = $request->name;
         $skill->proficiency = $request->proficiency;
         $skill->service_id = $request->service_id;
         $skill->save();

         return redirect()->route('admin.skills.index')->with('success', 'Skill has been Updated Successfully!');
    }

    public function destroy($id){
        $skill = Skill::find($id);
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill has been Deleted Successfully!');
    }
}

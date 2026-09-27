<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(){
        // $services = Service::latest()->get();
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $service = new Service();
        $service ->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();
        return redirect()->route('admin.services.index')->with('flash_message', 'Service has been added Successfully !');
    }

    public function edit($id){
        $service = Service::find($id);
        return view('admin.services.edit', compact('service'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $service = Service::find($id);
        $service ->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();

        return redirect()->route('admin.services.index',['page' => $request->page])->with('flash_message', 'Service Updated Successfully !');
        
    }

    public function destroy($id){
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('flash_message', 'Service Deleted Successfully !');

    }
}

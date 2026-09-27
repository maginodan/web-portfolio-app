<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
       $medias = Media::latest()->get(); 
       return view('admin.medias.index', compact('medias'));
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required',
            'icon' => 'required',
        ]);
        $media = new Media();
        $media->link = $request->link;
        $media->icon = $request->icon;
        $media->save();
        return redirect()->route('medias.index')->with('success', 'Social media added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required',
            'icon' => 'required',
        ]);

        $media = Media::findOrFail($id);

        $media->link = $request->link;
        $media->icon = $request->icon;
        $media->save();

        return redirect()->route('medias.index')->with('success', 'Social media updated successfully.');
    }

    public function destroy($id){
        $media = Media::find($id); 
        $media->delete();
        // return redirect()->route('medias.index')->with('flash_message', 'Social media deleted !');
        return redirect()->route('medias.index')->with('success', 'Social media deleted successfully.');

    }
}

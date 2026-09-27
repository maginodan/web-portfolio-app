<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::orderBy('id', 'DESC')->paginate(10);
        return view('admin.counters.index', compact('counters'));
    }


    public function store(Request $request)
    {
        $request->validate([
            "number" => "required",
            "label" => "required",
        ]);

        $counter = new Counter();

        $counter->number = $request->number;
        $counter->label = $request->label;
        $counter->order = $request->order;
        $counter->save();

        return redirect()->route('admin.counters.index')->with('success', 'Counter has been Added Successfully!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "number" => "required",
            "label" => "required",
        ]);

        $counter = Counter::find($id);

        $counter->number = $request->number;
        $counter->label = $request->label;
        $counter->order = $request->order;
        $counter->save();

        return redirect()->route('admin.counters.index')->with('success', 'Counter has been Updated Successfully!');
    }

    public function destroy($id){

        $counter = Counter::find($id);
        $counter->delete();

        return redirect()->route('admin.counters.index')->with('success', 'Counter Deleted Successfully!');
    }
}
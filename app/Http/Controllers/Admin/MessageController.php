<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::orderBy('id', 'DESC')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }


    public function edit($id){
        $message = Message::find($id);
        return view('admin.messages.edit', compact('message'));
    }

    public function update_status(Request $request, $id){
        $message = Message::find($id);
        $message->status = $request->status;
        $message->save();

        return redirect()->route('admin.messages.index')->with('flash_message', 'Message status Updated successfully!');

    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('flash_message', 'Message status Deleted successfully!');
    }
}

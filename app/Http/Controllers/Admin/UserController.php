<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    
    public function store(Request $request){

        $request->validate([
            "name" => "required|max:255",
            "email" => "required|string|lowercase|email|max:256|unique:".User::class,
            "password" => "required|min:8",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User Added successfully!');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->is_admin) {
            return redirect()->route('admin.users.index')->with('error', 'Admin accounts cannot be edited here.');
        }

        $request->validate([
            "name" => "required|max:255",
            "email" => [
                "required",
                "string",
                "lowercase",
                "email",
                "max:256",
                Rule::unique(User::class)->ignore($user),
            ],
            "password" => "nullable|min:8",
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User Updated successfully!');
    }

    public function destroy($id){
        $user = User::findOrFail($id);

        if ($user->is_admin) {
            return redirect()->route('admin.users.index')->with('error', 'Admin accounts cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User Deleted successfully!');
    }
}
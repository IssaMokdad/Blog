<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function addImage(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('uploads/', $filename);
        $user=User::find(Auth::id());
        $user->image=$filename;
        $user->save();
        return redirect()->back();}
    }

    public function index($userid){
        $user = User::find($userid);
        $list = Post::where('user_id',$userid)->orderBy('id', 'desc')->paginate(3);
        return view('profile', ['user'=>$user, 'list'=>$list]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($postid){
        $post = Post::find($postid);
        if(url()->previous()==url('home')){
        session(['getBackToHomePage'=>url()->previous()]);
        }
        return view('post', ['item'=>$post]);
    }

    public function showEdit($postid){
        $post = Post::find($postid);
        if(Auth::id()===$post['user_id']){
            return view('postedit', ['item'=>$post]);
        }
        else{
            return abort(404);
        }
    }

    public function add(Request $request){


        if ($request->hasFile('image')) {
            $request->validate([
                'title' => ['required', 'max:255'],
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('uploads/', $filename);
            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => $request->input('content'),
                'title' => $request->input('title'),
                'image'=>$filename,
            ]);
            return redirect('home');}
            else{
                $request->validate([
                    'title' => ['required', 'max:255'],
                    'content' => 'required',
                ]);
                $post = Post::create([
                    'user_id' => Auth::id(),
                    'content' => $request->input('content'),
                    'title' => $request->input('title'),
                ]);
                return redirect('home');
            }
        }

    public function edit(Request $request){
        if ($request->hasFile('image')){
                $request->validate([
                    'title' => ['required', 'max:255'],
                    'content' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('uploads/', $filename);
            $post = Post::where('id',$request->input('id') )->where('user_id', Auth::id())
            ->update(['title' => $request->input('title'), 'content'=>$request->input('content'), 'image'=>$filename]);
            if($post){
                return redirect()->back()->with('message', 'Edited Successfully!');
            }
             else{
                return redirect()->back()->with('message', 'Something went wrong!');
             }
        }
        else{
            $request->validate([
                'title' => ['required', 'max:255'],
                'content' => 'required',
                'id'      => 'required',
            ]);
            $post = Post::where('id',$request->input('id') )->where('user_id', Auth::id())
            ->update(['title' => $request->input('title'), 'content'=>$request->input('content')]);
            if($post){
                return redirect()->back()->with('message', 'Edited Successfully!');
            }
             else{
                return redirect()->back()->with('message', 'Something went wrong!');
             }
        }



    }

    public function delete(Request $request){
        $request->validate([
            'id' => ['required'],
        ]);
        Post::where('id',$request->input('id'))
        ->delete();
        return redirect(url('home'));
    }
}

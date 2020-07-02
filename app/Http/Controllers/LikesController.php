<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Likes;
use Illuminate\Support\Facades\Auth;
class LikesController extends Controller
{
    public function add(Request $request){
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 419);
        }
        $like = Likes::create([
            'post_id' => $data['id'],
            'user_id' => Auth::id(),
        ]);
        $like = $like->fresh();
        $count = Likes::where('post_id', $data['id'])->count();
        return response()->json(['total'=>$count]);
    }

    public function remove(Request $request){
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 419);
        }
        Likes::where('user_id',Auth::id())
               ->where('post_id', $data['id'])
               ->delete();
        $count = Likes::where('post_id', $data['id'])->count();
        return response()->json(['total'=>$count]);

    }
}

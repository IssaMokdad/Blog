<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function add(Request $request)
    {
        // var_dump(json_decode($request->json()->all()));

        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'comment' => ['required', 'string', 'max:255'],
            'id' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 419);
        }
        $comment = Comments::create([
            'comment' => $data['comment'],
            'post_id' => $data['id'],
            'user_id' => Auth::id(),
        ]);

        $comment = $comment->fresh();
        // $datas=[];
        // array_push($datas, $data, ['id'=>Auth::id()]);
        $commentTotal = Post::find($data['id']);
        $commentTotal = $commentTotal->comments->count();
        return response()->json(['comment' => $comment, 'commentTotal' => $commentTotal]);
        // return response()->json(['foo'=>'bar']);
    }
}

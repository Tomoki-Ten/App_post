<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $rules = [
            'comment' => 'required|max:200',
            'commentimage' => 'max:5000',
        ];
        $messages = [
            'comment.max' => '投稿可能な文字数は２００以下です。',
            'comment.required' => 'コメントを入力してください。',
            'commentimage.max' => 'イメージのサイズは５MBまでです。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $authId = Auth::id();

        $instance = new Comment;

        if($request->file('commentimage'))
        {
            $filecontent = $request->file('commentimage');

            $path = Storage::disk('s3')
                            ->putFile('/imageComment',$filecontent,'public');
            $url = Storage::disk('s3')
                            ->url($path);

            $instance->comment_image_path = $url;
        }

        $instance->user_id = $authId;
        $instance->post_id = $request->postid;
        $instance->comment = $request->comment;

        $instance->save();
        return back();
    }


    public function delete(Request $request)
    {
        $commentId = $request->commentid;
        $comment = Comment::find($commentId);
        $comment->delete();
        return back();
    }
    
}

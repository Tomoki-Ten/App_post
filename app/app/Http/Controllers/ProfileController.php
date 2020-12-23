<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function show($username)
    {
        // 認証 
        if(Auth::check())
        {
            $authid = Auth::id();
            $authdata = User::find($authid);

            $authprofile = $authdata->profile()
                                    ->first();
        }
        // ユーザー
        $userdata = User::where('name',$username)
                        ->first();
        // ユーザーのプロファイル
        $userprofile = $userdata->profile()
                                ->first();
        // ユーザーのポスト
        $userposts = Post::withCount('comments')
                            ->where('user_id',$userdata->id)
                            ->orderBy('updated_at','desc')
                            ->get();
        // ユーザーのコメント
        $usercomments = Comment::with('post')
                                ->where('user_id',$userdata->id)
                                ->orderBy('updated_at','desc')
                                ->get();
        if(Auth::check())
        {
            return view('pages.profile',[
                'authdata' => $authdata,
                'authprofile' => $authprofile,
                'userdata' => $userdata,
                'userprofile' => $userprofile,
                'userposts' => $userposts,
                'usercomments' => $usercomments
            ]);
        }
        else
        {   return view('pages.profile',[
                'userdata' => $userdata,
                'userprofile' => $userprofile,
                'userposts' => $userposts,
                'usercomments' => $usercomments
            ]);
        }

    }


    public function store(Request $request)
    {
        // バリデーション
        $rules = [
            'introduction' => 'max:200',
            'profileimage' => 'max:5000',
        ];
        $messages = [
            'introduction.max' => '投稿可能な文字数は２００以下です。',
            'profileimage.max' => 'イメージのサイズは５MBまでです。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return back()->withErrors($validator);
        }
        
        $authid = Auth::id();

        if(Profile::where('user_id',$authid)->first())
        {
            $instance = Profile::where('user_id',$authid)->first();
        }
        else
        {   $instance = new Profile;
            $instance->user_id = $authid;
        }

        // イメージ
        if($request->file('profileimage'))
        {
            $filecontent = $request->file('profileimage');

            $path = Storage::disk('s3')
                            ->putFile('/imageProfile',$filecontent, 'public');
            $url = Storage::disk('s3')
                            ->url($path);

            $instance->user_image = $url;
        }
        elseif(!$request->file('profileimage') && $request->noimage)
        {
            $instance->user_image = '';
        }
        
        // 紹介文
        if($request->introduction)
        {
            $instance->introduction = $request->introduction;
        }
        else
        {   $instance->introduction = '';
        }

        $instance->save();
        return back();
    }
}

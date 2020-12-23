<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;


class PostController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
    
/////////////////////////////////////////////////////
    public function index()
    {
        if(Auth::check())
        {
            $authId = Auth::id();
            $authdata = User::find($authId);

            $authprofile = $authdata->profile()
                                    ->first();

            $posts = Post::with('user')
                            ->orderBy('created_at','desc')
                            ->withCount('comments')
                            ->paginate(10);

            return view('pages.index',[
                'authdata' => $authdata,
                'authprofile' => $authprofile,
                'posts' => $posts,
            ]);
        }
        else
        {   $posts = Post::with('user')
                            ->orderBy('created_at','desc')
                            ->withCount('comments')
                            ->paginate(10);
                            // ->get();

            return view('pages.index',[
                'posts' => $posts
                ]);
        }
    }

/////////////////////////////////////////////////////
    public function search(Request $request)
    {
        $rules = [
            'key' => 'max:20',
        ];
        $messages = [
            'key.max' => '検索可能な文字数は２０以下です。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
        }
        
        
        if(Auth::check())
        {
            $authId = Auth::id();
            $authdata = User::find($authId);
            $authprofile = $authdata->profile()
                                    ->first();
        }

            $key = $request->key;
            $posts = Post::with('user')
                            ->where('post_text','like','%'.$key.'%')
                            ->orderBy('created_at','desc')
                            ->withCount('comments')
                            ->paginate(10);
                            // ->get();
            if(count($posts) == 0)
            {
                $message = '該当する投稿はありません。';
            }else{
                $message = '" '.$key.' " の検索結果。';
            }
        
        if(Auth::check())
        {
            return view('pages.index',[
                'authdata' => $authdata,
                'authprofile' => $authprofile,
                'posts' => $posts,
                'message' => $message
            ]);
        }
        else
        {   return view('pages.index',[
                'posts' => $posts,
                'message' => $message
                ]);
        }
    }

/////////////////////////////////////////////////////
    public function show($id)
    {
        if(Auth::check())
        {
            $authId = Auth::id();
            $authdata = User::find($authId);

            $authprofile = $authdata->profile()
                                    ->first();

            $post = Post::withCount('comments')
                        ->find($id);
            $comments = Comment::with('user')
                                ->where('post_id',$post->id)
                                ->orderBy('created_at','desc')
                                ->get();
                        
            if(Comment::where('post_id',$id)->where('user_id',$authId)->count())
            {
                $hascomment = true;
                $usercomment = Comment::with('user')
                                        ->where('user_id',$authId)
                                        ->where('post_id', $id)
                                        ->first();
            }
            else
            {   $hascomment = false;
                $usercomment = '';
            }

            return view('pages.showpost',[
                'authdata' => $authdata,
                'authprofile' => $authprofile,
                'post' => $post,
                'comments' => $comments,
                'hascomment' => $hascomment,
                'usercomment' => $usercomment
            ]);
        }
        else
        {   $post = Post::withCount('comments')
                        ->find($id);

            $comments = Comment::with('user')
                                ->where('post_id',$post->id)
                                ->orderBy('created_at','desc')
                                ->get();
            
            return view('pages.showpost',[
                'post' => $post,
                'comments' => $comments
            ]);
        }
    }

/////////////////////////////////////////////////////
    public function store(Request $request)
    {
        // バリデーション
        $rules = [
            'title' => 'required|max:50',
            'post' => 'required|max:800',
            'postimage' => 'max:5000',
        ];
        $messages = [
            'title.max' => 'タイトルの文字数は５０以下です。',
            'title.required' => 'タイトルを入力してください。',
            'post.max' => '投稿可能な文字数は８００以下です。',
            'post.required' => '投稿内容を入力してください。',
            'postimage.max' => 'イメージのサイズは５MBまでです。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $authId = Auth::id();

        $instance = new Post;

        if($request->file('postimage'))
        {
            $filecontent = $request->file('postimage');
    
            $path = Storage::disk('s3')
                            ->putFile('/imagePost',$filecontent,'public');
            $url = Storage::disk('s3')
                            ->url($path);
            
            $instance->post_image_path = $url;
        }


        $instance->user_id = $authId;
        $instance->title = $request->title;
        $instance->post_text = $request->post;

        $instance->save();
        return back();
    }

/////////////////////////////////////////////////////
    public function edit(Request $request)
    {
        // バリデーション
        $rules = [
            'title' => 'required|max:50',
            'post' => 'required|max:800',
            'postimage' => 'max:5000',
        ];
        $messages = [
            'title.max' => 'タイトルの文字数は５０以下です。',
            'title.required' => 'タイトルを入力してください。',
            'post.max' => '投稿可能な文字数は８００以下です。',
            'post.required' => '投稿内容を入力してください。',
            'postimage.max' => 'イメージのサイズは５MBまでです。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return back()
                    ->withErrors($validator);
        }
        
        $postid = $request->postid;
        $instance = Post::find($postid);

        if($request->file('postimage'))
        {
            $filecontent = $request->file('postimage');
    
            $path = Storage::disk('s3')
                            ->putFile('/imagePost',$filecontent,'public');
            $url = Storage::disk('s3')
                            ->url($path);
            
            $instance->post_image_path = $url;
        }
        elseif(!$request->file('postimage') && $request->editsign)
        {
            $instance->post_image_path = '';
        }

        $instance->title = $request->title;
        $instance->post_text = $request->post;

        $instance->save();
        return back();
    }

/////////////////////////////////////////////////////
    public function delete(Request $request)
    {
        $postid = $request->postid;
        $post = Post::find($postid);

        $post->delete();
        
        return redirect('/');
    }
    
}

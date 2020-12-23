@extends('layouts.basic')


@section('title','Post Display Box')


@section('sidebar')
  <!-- Sidebar -->
  @guest
    @include('components.sidebar')
  @endguest

  @auth
    @include('components.sidebar',
      [
        'authprofile' => $authprofile,
        'authdata' => $authdata
      ])
  @endauth
    
  <!---------- Modal Window ----------->
    @auth
      <!----- POST Modal Window ----->
      @include('components.modal',
        [
          'authprofile' => $authprofile,
          'authdata' => $authdata
        ])

      <!----- POST (Edit) Modal Window ----->
      @include('components.modal_post_edit',
          [
            'authprofile' => $authprofile,
            'authdata' => $authdata,
            'post' => $post
          ])
      
      <!----- Comment Modal Window ----->
      @include('components.modal_comment',
          [
            'authprofile' => $authprofile,
            'authdata' => $authdata,
            'post' => $post
          ])
      
    @endauth
@endsection


@section('main')
  <!-- Main -->
  <main class="d-flex justify-content-center">
  
    <div class="postcontainer">
      

      <div class="post shadow">

        <div class="postinfo d-flex">
          
          @empty( $post->user->profile->user_image )
            <i class="fas fa-user-circle post-default-userimage"></i>
          @endempty

          @if(!empty($post->user->profile->user_image))
            <img src="{{ $post->user->profile->user_image }}" alt="userimage" class="post-userimage">
          @endif


          <div class="postdatacontainer">

              <a class="postusername" href="/profile/show/{{ $post->user->name }}">
                {{ $post->user->name }}
              </a>

              <p class="postdate">
                {{ $post->updated_at }}
              </p>

          </div>

        </div>

        @if( $post->post_image_path )
          <span>

              <img class="postimage" src="{{ $post->post_image_path }}" alt="posted image">

          </span>
        @endif

        <div class="textcontainer">

            <span class="posttitle" href="/post/show/{{ $post->id }}">{{ $post->title }}</span>

            <p class="posttext">{{ $post->post_text }}</p>

        </div>
        
        <hr>

        <div class="postbottom d-flex justify-content-end">

            <span class="show-count">コメント: {{ $post->comments_count }}件</span>

        </div>

      </div>
      
      @auth
        <!-- 自分の投稿だった場合  -->
        @if( $authdata->id === $post->user_id)
          <div class="d-flex justify-content-center shadow show-action-container">

              <button class="btn btn-primary show-edit-btn">

                  <i class="far fa-edit"></i>
                  編集する

              </button>


              <form action="/post/delete" method="post" class="show-delete-form">
                @csrf
                <input type="hidden" name="postid" value="{{ $post->id }}">

                <button type="button" class="btn btn-secondary show-delete-btn">

                    <i class="far fa-trash-alt"></i>
                    削除する

                </button>
              </form>

          </div>
        @else
          <!-- 他のユーザーの投稿の場合 -->
          @if( $hascomment === false ) 

            <!-- 未だコメントしていない場合 -->
            <div class="d-flex justify-content-center shadow show-action-container">

              <button class="btn btn-primary show-comment-btn">

                  <i class="fas fa-comment-alt"></i>
                  コメントする

              </button>
              
            </div>
            
          @else
            <!-- 既にコメントを投稿している場合 -->
            <div class="show-comments-container">

              <div class="show-comment shadow">

                  <div class="yourcomment-container">

                      <p class="text-center text-primary yourcomment-alert">
                        この投稿に対する、あなたのコメント
                      </p>

                      <hr>

                      <p class="comment-text">
                        {{ $usercomment->comment }}
                      </p>

                  </div>

                  @if( $usercomment->comment_image_path )
                    <img src="{{ $usercomment->comment_image_path }}" alt="comment-image" class="comment-image">
                  @endif

                  <p class="comment-info text-right ">
                    {{ $usercomment->updated_at }}
                  </p>

                  <hr>

                  <form class="comment-delete-btn-form d-flex justify-content-center" action="/comment/delete" method="post">
                    @csrf
                      <input type="hidden" name="commentid" value="{{ $usercomment->id }}">
                      
                      <button type="button" class="btn btn-primary comment-delete-btn">

                          <i class="far fa-trash-alt"></i>
                          このコメントを削除する

                      </button>

                  </form>

              </div>

            </div>
          @endif
        @endif
      @endauth
      
      
      <!----- All of Comments ----->
      <div class="show-comments-container">
        @foreach($comments as $comment)

          @auth
              @continue($authdata->id === $comment->user_id)
          @endauth

          <div class="show-comment shadow">

              <div class="comment-userdata-container d-flex">

                  @empty( $comment->user->profile->user_image )
                    <i class="fas fa-user-circle show-comment-default-image"></i>
                  @endempty

                  @if(!empty($comment->user->profile->user_image))
                    <img src="{{ $comment->user->profile->user_image }}" alt="userimage" class="show-comment-user-image">
                  @endif
                  
                  <div>

                    <a href="/profile/show/{{ $comment->user->name }}">
                      {{ $comment->user->name}}
                    </a>

                    <p class="comment-updated-at">
                      {{ $comment->updated_at }}
                    </p>

                  </div>

              </div>

              <p class="comment-text-in-foreach">
                {{ $comment->comment }}
              </p>

              @if( $comment->comment_image_path )
                <img src="{{ $comment->comment_image_path }}" alt="comment-image" class="comment-image">
              @endif

          </div>
        @endforeach
      </div>
      
      
    </div>
  </main>
@endsection


@section('right')
  <!-- Right Sidebar -->
    <x-right/>
@endsection


<!-- JS File Selector -->
@section('jsfiles')
  @auth
    <script src="{{ asset('js/main.js') }}"></script>


      @if($authdata->id === $post->user_id)
        <script src="{{ asset('js/post_show.js') }}"></script>

      @else

          <!-- コメント済　の場合 -->
          @if( $hascomment === false )
            <script src="{{ asset('js/comment.js') }}"></script>

          @else
          <!-- 未だコメントしていない場合 -->
            <script src="{{ asset('js/comment_delete.js') }}"></script>

          @endif

      @endif

  @endauth
@endsection
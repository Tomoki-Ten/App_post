@extends('layouts.basic')


@section('title', 'Home')


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


  <!-- Modal Window -->
  @auth
    <!----- POST Modal Window ----->
    @include('components.modal',
      [
          'authprofile' => $authprofile,
          'authdata' => $authdata
      ])
  @endauth
@endsection


@section('main')
  <!-- Main -->
  <main class="d-flex justify-content-center">
  
    <div class="postcontainer">

    @isset($message)
      <!-- 検索結果メッセージ -->
      <div class="alert alert-light text-center shadow search-message" role="alert">{{ $message}}</div>
    @endisset

      
    @foreach($posts as $post)
      <div class="post shadow">

        <div class="postinfo d-flex">

            @empty( $post->user->profile->user_image )
              <i class="fas fa-user-circle post-default-userimage"></i>
            @endempty

            @if(!empty($post->user->profile->user_image))
              <img src="{{ $post->user->profile->user_image }}" alt="userimage" class="post-userimage">
            @endif
            

            <div class="postdatacontainer">
                <p class="postusername">

                  <a href="/profile/show/{{ $post->user->name }}">
                  {{ $post->user->name }}
                  </a>
                  
                </p>

                <p class="postdate">{{ $post->updated_at }}</p>

            </div>
            
        </div>

        @if( $post->post_image_path )
          <a href="/post/show/{{ $post->id }}">

            <img class="postimage" src="{{ $post->post_image_path }}" alt="posted image">

          </a>
        @endif

        <div class="textcontainer">

            <a class="posttitle" href="/post/show/{{ $post->id }}">{{ $post->title }}</a>
            <p class="posttext">{{ $post->post_text }}</p>

        </div>
        
        <hr>

        <div class="postbottom d-flex justify-content-end">

            <span>コメント: {{ $post->comments_count }}件</span>

        </div>

      </div>
    @endforeach

    <!-- ぺジネーション -->
    <div class="my-3">
      {{ $posts->onEachSide(1)->links() }}
    </div>

    
    </div>
  </main>
@endsection


@section('right')
  <!-- Right Sidebar -->
    <x-right/>
@endsection


@section('jsfiles')

  @auth
    <script src="{{ asset('js/main.js') }}"></script>
  @endauth

@endsection

@extends('layouts.basic')


@section('title', 'User Profile')


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
  
  <!--------- Modal Window --------->
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

  <div class="profile-main">


    <div class="profile-container">
    
      <div class="profile-image-container d-flex justify-content-center">

        @empty($userprofile->user_image)
          <i class="fas fa-user-circle profile-default-image"></i>
        @endempty
        
        @if(!empty($userprofile->user_image))
          <img src="{{ $userprofile->user_image }}" alt="userimage" class="profile-user-image">
        @endif
            
      </div>

      <p class="text-center profile-username">{{ $userdata->name }}</p>
      
      <div class="text-center">

        @empty($userprofile->introduction)
          <p>
            紹介文は未設定です。
          </p>
        @endempty
        
        @if(!empty($userprofile->introduction))
          <p>
            {{ $userprofile->introduction }}
          </p>
        @endif
      
      </div>
    </div>


    <ul class="nav nav-pills mt-3 pb-0" id="tab" role="tablist">

      <li class="nav-item">

          <a class="nav-link active" id="posts-tab" data-toggle="pill" href="#navposts" role="tab" aria-controls="posts" aria-selected="true">Posts</a>

      </li>
      
      <li class="nav-item">

          <a class="nav-link" id="comments-tab" data-toggle="pill" href="#navcomments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>

      </li>

      @auth
          @if(Auth::id() === $userdata->id)
              <li class="nav-item">
                  <a class="nav-link" id="settings-tab" data-toggle="pill" href="#navsettings" role="tab" aria-controls="settings" aria-selected="false">
                  
                      Settings

                  </a>
              </li>
          @endif
      @endauth
    </ul>


    <div class="tab-content" id="myTabContent">
      <!------- Posts Tab ------->
      @include('components.tab_posts',
      [
          'userposts' => $userposts
      ])

      <!------- Comments Tab -------->
      @include('components.tab_comments',
      [
          'usercomments' => $usercomments
      ])
      

      <!----- Settings Tab ----->
      @auth
      @if(Auth::id() === $userdata->id)
      <div class="tab-pane fade setting-container" id="navsettings" role="tabpanel" aria-labelledby="settings-tab">

        <div class="d-flex justify-content-center">
            @empty($userprofile->user_image)

                <div class="text-center" id="preview-default">
                    <p>
                        No Image
                    </p>
                </div>

                <img src="" alt="profile preview" class="profile-preview hidden">

            @endempty
            
            @if(!empty($userprofile->user_image))

                <div class="text-center hidden" id="preview-default">
                    <p>
                        No Image
                    </p>
                </div>

                <img src="{{ $userprofile->user_image }}" alt="profile preview" class="profile-preview">

            @endif
              
        </div>

        <form action="/profile/store" method="post" enctype="multipart/form-data" id="profile-form">
          @csrf
          
          <div class="d-flex">

            <label for="profileimage" class="profilelabel btn btn-outline-primary">

              <i class="far fa-image fa-lg pt-2"></i>

              画像をアップロード

              <input type="file" name="profileimage" id="profileimage" accept="image/png,image/jpeg">
              
            </label>
        

            <!-- Checkbox -->
            @empty($userprofile->user_image)

                <label for="close-ckbox" class="hidden" id="close-label">

                    <i class="fas fa-times-circle fa-2x profile-close"></i>
                    
                </label>

                <input type="checkbox" id="close-ckbox" name="noimage" checked hidden>

            @endempty

            @if(!empty($userprofile->user_image))

                <label for="close-ckbox" id="close-label">
                
                    <i class="fas fa-times-circle fa-2x profile-close"></i>

                </label>
                
                <input type="checkbox" id="close-ckbox" name="noimage" hidden>

            @endif
              
          </div>
          
          <p>
              <textarea name="introduction" id="introduction-form" cols="54" rows="4" placeholder=紹介文を設定する事が出来ます。(200字以内)>{{ $userprofile->introduction ?? ''}}</textarea>
          </p>

          <p>
              <input type="submit" class="btn btn-success set-btn" value="設定を変更する">
          </p>

        </form>
        
      </div>
      @endif
      @endauth

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

    @if(Auth::id() === $userdata->id)
    <script src="{{ asset('js/settings.js') }}"></script>
    @endif

  @endauth
@endsection

<aside class="d-flex justify-content-between">
  <ul class="nav flex-column">
    <form class="search" action="/post/search" method="get">
      <i class="fa fa-search pr-2 fa-lg"></i>
      <input class="searchform" type="text" name="key" placeholder="検索......(20字以内)" value="{{old('key')}}"required>
      <input type="submit" hidden>
    </form>
      
    @guest
      <li class="nav-item">

          <i class="fas fa-home pl-2 fa-lg home"></i>
          <a class="nav-link" href="/">Home</a>

      </li>
      
      <li class="nav-item">

          <i class="fas fa-sign-in-alt pl-2 fa-lg login"></i>
          <a class="nav-link" href="/login">ログイン</a>

      </li>

      <li class="nav-item">

          <i class="fas fa-user-plus pl-2 fa-lg register"></i>
          <a class="nav-link" href="/register">登録</a>

      </li>
    @endguest

    @auth
      <li class="nav-item">

        @empty($authprofile->user_image)
          <i class="fas fa-user-circle sidebar-default-image"></i>
        @endempty

        @if(!empty($authprofile->user_image))
          <img src="{{ $authprofile->user_image }}" alt="userimage" class="sidebar-user-image">
        @endif
     
        <a href="/profile/show/{{ $authdata->name }}"class="nav-link sidebarusername">{{ $authdata->name }}</a>

      </li>

      <li class="nav-item">

          <i class="fas fa-home pl-2 fa-lg home"></i>
          <a class="nav-link" href="/">Home</a>

      </li>

      <li class="nav-item">

          <i class="fas fa-sign-out-alt pl-2 fa-lg"></i>
          <a class="nav-link" href="/logout">ログアウト</a>
          
      </li>

      <li class="nav-item">

          <i class="fas fa-plus-circle pl-2 fa-lg toukou"></i>
          <span class="nav-link " id="sidebar-post">投稿</span>

      </li>
    @endauth
  </ul>

  <!-- エラー表示リスト -->
  @if(count($errors) > 0)
  <ul class="alert-container">

      <li class="alert alert-danger text-center alert-top" role="alert">

          <span class="alert-link">入力エラー</span>

      </li>

      <!-- ポストエラー -->
      @error('title')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      @error('post')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      @error('postimage')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      <!-- コメントエラー -->
      @error('comment')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      @error('commentimage')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      <!-- プロフィールエラー -->
      @error('introduction')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      @error('profileimage')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

      <!-- 検索エラー -->
      @error('key')
      <li class="alert alert-danger" role="alert">{{ $message }}</li>
      @enderror

  </ul>
  @endif

  <footer>

    <ul>

      <li class="text-center">

          <a href="">プライバシー</a>/

          <a href="">利用規約</a>/

          <a href="">その他</a>  

      </li>

      <li class="text-center">

          Post!-Post!-Post! ©︎ 2020

      </li>

    </ul>
  </footer>
</aside>
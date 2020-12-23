
<div id="modal" class="hidden">

  <div class="d-flex justify-content-end">

      <p class="modalsubject">投稿を作成</p>
      <i class="closeicon fas fa-times-circle fa-2x" id="form-close"></i>

  </div>

  <hr>


  <div class="modalpostinfo d-flex justify-content-start">

    @empty($authprofile->user_image)
      <i class="fas fa-user-circle"></i>
    @endempty

    @if(!empty($authprofile->user_image))
        <img src="{{ $authprofile->user_image }}" alt="user-image">
    @endif
      
    <span class="modalusername align-middle">
      {{ $authdata->name }}
    </span>

  </div>


  <form action="/post/store" method="post" enctype="multipart/form-data">
  @csrf
      <p>
        <input type="text" class="formtitle" name="title" placeholder="タイトル(50字以内)" value="{{ old('title') }}" required>
      </p>

      <p>
        <textarea class="formpost" name="post" cols="30" rows="8" placeholder="投稿内容(800字以内)" required>{{ old('post') }}</textarea>
      </p>

      <label for="file-selector" class="filelabel btn btn-primary">
          <i class="far fa-image fa-lg"></i>
          ファイルをアップロード
          <input type="file" name="postimage" id="file-selector" accept="image/png,image/jpeg">
      </label>


      <div id="preview-holder" class="hidden">

          <i id="preview-close" class="fas fa-times-circle fa-2x"></i>
          <img src="" id="preview">

      </div>
      
      <p>
        <input type="submit" class="submitbtn btn btn-success" value="投稿する">
      </p>

  </form>
</div>

<div id="mask" class="hidden"></div>
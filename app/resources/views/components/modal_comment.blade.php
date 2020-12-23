
<div id="modal-comment" class="hidden">
  <div class="d-flex justify-content-end">
    <p class="modalsubject">コメントを作成</p>
    <i class="closeicon fas fa-times-circle fa-2x" id="comment-form-close"></i>
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

  <form action="/comment/store" method="post" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="postid" value="{{ $post->id }}">
    
    <p>
      <textarea class="formpost" name="comment" cols="30" rows="4" placeholder="コメント(200字以内)" required>{{ old('comment') }}</textarea>
    </p>

    <label for="comment-file-selector" class="filelabel btn btn-primary">
        <i class="far fa-image fa-lg"></i>
        画像をアップロード
        <input type="file" name="commentimage" id="comment-file-selector" accept="image/png,image/jpeg">
    </label>

    <div id="comment-preview-holder" class="hidden">
      <i id="comment-preview-close" class="fas fa-times-circle fa-2x"></i>
      <img src="" id="comment-preview">
    </div>

    <p>
      <input type="submit" class="submitbtn btn btn-success" value="投稿する">
    </p>
  </form>
</div>

<div id="mask-comment" class="hidden"></div>
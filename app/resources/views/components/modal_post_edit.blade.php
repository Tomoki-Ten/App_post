
<div id="modal-post-edit" class="hidden">
  <div class="d-flex justify-content-end">
    <p class="modalsubject">投稿を編集</p>
    <i class="closeicon fas fa-times-circle fa-2x" id="edit-form-close"></i>
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


  <form action="/post/edit" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="postid" value="{{ $post->id }}">

    <p>
      <input type="text" class="formtitle" name="title" placeholder="タイトル(50字以内)" value="{{ $post->title }}" required>
    </p>

    <p>
      <textarea class="formpost" name="post" cols="30" rows="8" placeholder="投稿内容(800字以内)" required>{{ $post->post_text }}</textarea>
    </p>

    <label for="edit-file-selector" class="filelabel btn btn-primary">

        <i class="far fa-image fa-lg"></i>
        画像をアップロード
        <input type="file" name="postimage" id="edit-file-selector" accept="image/png,image/jpeg">

    </label>

    <!-- Checkbox -->
    @empty($post->post_image_path)
      <div id="edit-preview-holder" class="hidden">

          <label for="edit-sign" class="edit-close-label hidden">

              <i id="edit-preview-close" class="fas fa-times-circle fa-2x"></i>

          </label>

          <img src="" id="edit-preview">

          <input type="checkbox" name="editsign" id="edit-sign" checked hidden>

      </div>
    @endempty

    @if(!empty($post->post_image_path))
        <div id="edit-preview-holder">

            <label for="edit-sign" class="edit-close-label">

                <i id="edit-preview-close" class="fas fa-times-circle fa-2x"></i>

            </label>
        
            <img src="{{ $post->post_image_path }}" id="edit-preview">

            <input type="checkbox" name="editsign" id="edit-sign" hidden>
            
        </div>
    @endif
      
      
    <p>
      <input type="submit" class="submitbtn btn btn-success" value="編集を完了する">
    </p>
  </form>

</div>

<div id="edit-mask" class="hidden"></div>
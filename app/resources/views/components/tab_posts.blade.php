<div class="tab-pane fade show active postcontainer" id="navposts" role="tabpanel" aria-labelledby="posts-tab">
  @forelse($userposts as $post)
    <div class="post shadow">

      @if( $post->post_image_path )

        <a href="/post/show/{{ $post->id }}">
          <img class="postimage" src="{{ $post->post_image_path }}" alt="posted image" style="border-radius:8px 8px 0 0">
        </a>
        
      @endif

      <div class="textcontainer">
      
          <a class="posttitle" href="/post/show/{{ $post->id }}">{{ $post->title }}</a>

          <p class="posttext">{{ $post->post_text }}</p>

      </div>

      <p class="post-updated-at text-right">{{ $post->updated_at }}</p>
      
      <hr>

      <div class="post-tab-bottom d-flex justify-content-end">

          <span>コメント: {{ $post->comments_count }}件</span>

      </div>

    </div>

  @empty
    <div class="alert alert-light text-center shadow comment-message">投稿がありません。</div>
  @endforelse

</div>
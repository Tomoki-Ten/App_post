<div class="tab-pane fade profile-comments-container" id="navcomments" role="tabpanel" aria-labelledby="comments-tab">
  @forelse($usercomments as $comment)
    <div class="show-comment shadow">
  
      <div class="comment-tab-upper">
        <p class="re-postname">
          Re:
        @if($comment->post)
        <a href="/post/show/{{ $comment->post->id }}">
          {{ $comment->post->title }}
        </a>
        @else
        <span class="no-post">コメント先の投稿は削除されています。</span>
        @endif
        </p>
        <p>
          {{ $comment->comment }}
        </p>
      </div>

      @if( $comment->comment_image_path )
      <img src="{{ $comment->comment_image_path }}" alt="comment-image" class="comment-image">
      @endif

      <p class="comment-updated-at text-right pr-4">
        {{ $comment->updated_at }}
      </p>
    </div>
  @empty
    <div class="alert alert-light text-center shadow comment-message">コメントがありません。</div>
  @endforelse
</div>
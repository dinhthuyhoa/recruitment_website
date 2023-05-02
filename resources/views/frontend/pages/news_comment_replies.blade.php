@foreach ($comments as $comment)
    @if (
        $comment->user->role == \App\Enums\UserRole::Administrator ||
            (Auth::check() && Auth::user()->role == $comment->user->role) ||
            (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Administrator))
        <div
            class="display-comment {{ !is_null($comment->parent_id) ? 'd-none comment-child-of-' . $comment->parent_id : null }}">
            <div class="comment-info">
                <strong>{{ $comment->user->name }}</strong>
                <span class="text-secondary"> | {{ date('H:i d/m/Y', strtotime($comment->created_at)) }}</span>
                <p class="m-0 text-dark">{{ $comment->body }}</p>
            </div>
            <div class="ml-3 my-2">
                <a class="btn-reply-comment" href="javascript:void(0);" data-comment-id="{{ $comment->id }}">
                    <i class="fas fa-comment"></i> Reply
                </a>

                @if (is_null($comment->parent_id) && count($comment->comment_children()) > 0)
                    | <a class="btn-show-comment-child" id="btn-show-comment-child-{{ $comment->parent_id }}"
                        href="javascript:void(0);" data-hide-comment='false'
                        data-count-comment='{{ count($comment->comment_children()) }}'
                        data-comment-id="{{ $comment->id }}">
                        Show all
                        {{ count($comment->comment_children()) }} comment</a>
                @endif
            </div>
            <form method="post" action="{{ route('reply.add') }}" class="form-reply-comments d-none"
                id="form-reply-comment-{{ $comment->id }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id"
                    value="{{ !is_null($comment->parent_id) ? $comment->parent_id : $comment->id }}" />

                <div class="form-group group-reply-comment d-flex align-items-end">
                    <textarea type="text" name="comment_body" class="ckeditor form-control textarea-comment">{!! '@' . $comment->user->name . ' ' !!}</textarea>
                    <button type="submit" class="btn btn-info" value="Reply"><i class="fa fa-send"></i></button>
                </div>
            </form>
            @include('frontend.pages.comment_replies', ['comments' => $comment->replies])
        </div>
    @endif
@endforeach

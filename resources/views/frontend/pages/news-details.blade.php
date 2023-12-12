@extends('frontend.master.master')

@section('css')
@endsection

@section('content')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3 class="post-title">{{ $post->post_title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 posts-list">
                <div class="single-post">
                    <div class="blog_details p-5">
                    <div class="feature-img d-flex justify-content-center mb-5">
                        <img class="img-fluid" src="{{ asset('storage/' . $post->post_image) }}" alt="">
                    </div>
                        <h2>{{ $post->post_title }}</h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><span><i class="fa fa-user"></i> {{ $post->author }}</span></li>
                            <li><span><i class="fa fa-comments"></i> {{ count($post->comments) }}
                            {{trans('comment.comment')}}</span></li>
                            <li><span><i class="fa fa-eye"></i> {{ $post->post_view }} {{trans('comment.view')}}</span></li>
                        </ul>

                        <p>{!! $post->post_content !!}</p>

                    </div>
                </div>
                <div class="navigation-top px-5 d-flex align-items-center justify-content-between">
                    <div class="d-sm-flex justify-content-between text-center">
                        <div class="d-flex justify-content-between">
                            <strong>
                                <span id="post-info-count-reactions">
                                    {{ count($post->reacts()) }}
                                </span> {{trans('comment.reaction')}}
                            </strong>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="box-emoji-react">
                        <div class="box-reations">

                            @if (Auth::check() && !is_null($post->myReact()) && $post->myReact()->status != 'deactivate')
                            @foreach (config('emoji') as $emoji_key => $emoji_icon)
                            <input type="radio" name="react-raido" id="{{ $emoji_key }}" data-post-id="{{ $post->id }}" value="{{ $emoji_key }}" {{ $post->myReact()->emoji == $emoji_key ? 'checked' : null }}>

                            <label for="{{ $emoji_key }}" class="react {{ $post->myReact()->emoji == $emoji_key ? 'checked' : null }}">
                                <i data-icon="{{ $emoji_icon }}"></i>
                            </label>
                            @endforeach
                            @else
                            @foreach (config('emoji') as $emoji_key => $emoji_icon)
                            <input type="radio" name="react-raido" id="{{ $emoji_key }}" data-post-id="{{ $post->id }}" value="{{ $emoji_key }}">
                            <label for="{{ $emoji_key }}" class="react">
                                <i data-icon="{{ $emoji_icon }}"></i>
                            </label>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <!-- <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="">
                        <div class="media-body">
                            <a href="#">
                                <h4><a href="{{ route('profile', $post->user_id) }}" target="_blank">{{ $post->author }}</a></h4>
                            </a>
                            <p>{{ $post->post_description }}</p>
                        </div>
                    </div>
                </div> -->
                <div class="comments-area px-5">
                    <strong>{{ count($post->comments) }} {{trans('comment.comment')}}</strong>
                    <div class="comment-list">
                        @include('frontend.pages.news_comment_replies', [
                        'comments' => $post->comments,
                        'post_id' => $post->id,
                        'post_user_id' => $post->user_id,
                        ])
                        <hr />
                        
                        @if (Auth::check())
                        <h4>{{trans('comment.add_comment')}}</h4>
                        <form method="post" action="{{ route('comment.add') }}">
                            @csrf
                            <div class="form-group">
                                <textarea type="text" name="comment_body" class="form-control"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Add Comment" />
                            </div>
                        </form>
                        @else
                        <a class="btn d-flex align-items-center justify-content-center" href="{{ route('login', ['url' => url()->full()]) }}">{{trans('comment.login_to_comments')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4">
                <div class="blog_right_sidebar">


                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">{{trans('all-jobs.tag')}}</h4>
                        <ul class="list">
                            <form action="{{ route('posts.news.list') }}" class="d-flex flex-wrap" style="gap: 15px">
                                @foreach ($post->tags as $tag)
                                <button class="btn btn-secondary" type="submit" name="tag" value="{{ $tag->tag_key }}">
                                    {{ $tag->tag_name }}
                                </button>
                                @endforeach
                            </form>
                        </ul>
                    </aside>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->
@endsection

@section('js')
<script>
    function shortenTitle(title, maxLength) {
        if (title.length > maxLength) {
            var shortenedPart = title.substring(0, maxLength);
            return shortenedPart + '...';
        } else {
            return title;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var postTitles = document.querySelectorAll(".post-title");
        postTitles.forEach(function(postTitle) {
            var originalTitle = postTitle.textContent.trim();
            var shortenedTitle = shortenTitle(originalTitle, 60);
            postTitle.textContent = shortenedTitle;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.btn-reply-comment').on('click', function() {
            const idComment = $(this).data('comment-id')
            $('.form-reply-comments').addClass('d-none');
            $('#form-reply-comment-' + idComment).removeClass('d-none');
        })

        $('.btn-show-comment-child').on('click', function() {
            const countComment = $(this).data('count-comment');
            const idComment = $(this).data('comment-id');

            if ($(this).data('hide-comment') == 'false') {
                $('.comment-child-of-' + idComment).removeClass('d-none');
                $(this).html('Hide all ' + countComment + ' comment');
                $(this).data('hide-comment', 'true')
            } else {
                $('.comment-child-of-' + idComment).addClass('d-none');
                $(this).html('Show all ' + countComment + ' comment');
                $(this).data('hide-comment', 'false')

            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('.box-reations input[type=radio]').on('click', function() {
            const valEmoji = $(this).val()
            $.ajax({
                type: "POST",
                url: '/reactions',
                dataType: 'json',
                data: {
                    'type_id': $(this).data('post-id'),
                    'react_type': 'post',
                    'emoji': valEmoji,
                },
                success: function(data) {
                    $('#post-info-count-reactions').html(data.countReact)
                    if (data.status == 'deactivate') {
                        $('.box-reations label').removeClass('checked');
                    } else {
                        $('.box-reations label').removeClass('checked');
                        console.log(valEmoji)
                        $('.box-reations label[for="' + valEmoji + '"]')
                            .addClass('checked');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (textStatus == 'timeout') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error : Timeout for this call!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                timeout: 10000
            });
        })
    })
</script>
@endsection
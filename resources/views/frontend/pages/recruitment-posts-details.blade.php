@extends('frontend.master.master')

@section('content')
<!-- bradcam_area  -->
<!-- <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{ $post->post_title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!--/ bradcam_area  -->

<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if (Auth::check() && Auth::user()->is_apply($post->id))
                <div class="d-flex bg-success text-white p-2 mb-3" style="border-radius: 10px">
                    {{trans('all-jobs.notification_apply')}} {{ Auth::user()->apply_count($post->id) }} {{trans('all-jobs.count_times')}}
                </div>
                @endif
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img src="{{ asset('storage/' . $post->post_image) }}" alt="">
                            </div>

                            <div class="jobs_conetent fw-bold">
                                <a href="#">
                                    <h4>{{ $post->post_title }}</h4>
                                </a>
                                <div>
                                    <h6>
                                        <a href="{{ route('profile', $post->user_id) }}" target="_blank">{{ $post->author }}</a>
                                        
                                    </h6>
                                </div>
                                
                                <div class="links_locat d-flex align-items-center">
                                    <div class="location ">
                                        <p class="fs-61"> <i class="fa fa-map-marker"></i> {{ $post->recruitment_address }}</p>
                                    </div>
                                    
                                    <!-- <div class="location">
                                        <p> <i class="fa fa-eye"></i> {{ $post->post_view }}</p>
                                    </div> -->
                                </div>
                                <div class="location job-nature">
                                    <p> <i class="fa fa-clock-o"></i> {{ $post->recruitment_job_nature }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                @if (Auth::check())
                                <a class="heart_mark" href="javascript:void(0);" onclick="change_favotire({{ $post->id }},{{ Auth::user()->id }}, this)">
                                    @if (Auth::user()->is_post_favorite($post->id))
                                    <i class="fa fa-heart"></i>
                                    @else
                                    <i class="ti-heart"></i>
                                    @endif
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="descript_wrap white-bg">
                    {!! $post->post_content !!}
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>
                            <span id="post-info-count-reactions">
                                {{ count($post->reacts()) }}
                            </span> reactions
                        </strong>
                        <strong>
                            <span id="post-info-count-comments">
                                {{ count($post->comments) }}
                            </span> comment
                        </strong>
                    </div>
                    <hr>
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
                <hr />
                <h4>Comments</h4>
                <hr>
                @include('frontend.pages.comment_replies', [
                'comments' => $post->comments,
                'post_id' => $post->id,
                'post_user_id' => $post->user_id,
                ])
                <hr />
                <h4>Add comment</h4>
                @if (Auth::check())
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
                <a class="btn btn-info" href="{{ route('login', ['url' => url()->full()]) }}">{{trans('all-jobs.note_logins')}}</a>
                @endif


            </div>
            <div class="col-lg-4">
                <div class="job_summary">
                    <div class="summery_header">
                        <h3>{{trans('all-jobs.job_summery')}}</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>{{trans('all-jobs.published_on')}} <span>{{ $post->post_date }}</span></li>
                            <li>{{trans('all-jobs.updated_on')}}: <span>{{ $post->post_date_update }}</span></li>
                            <li>{{trans('admin-auth.vacancy')}}: <span>{{ $post->recruitment_vacancy }}</span></li>
                            <li>{{trans('admin-auth.salary')}}: <span>{{ $post->recruitment_salary }}</span></li>
                            <li>{{trans('admin-auth.location_recruitment')}}: <span>{{ $post->recruitment_address }}</span></li>
                            <li>{{trans('admin-auth.job_nature')}}: <span>{{ $post->recruitment_job_nature }}</span></li>
                            <li>{{trans('admin-auth.experience')}}: <span>{{ $post->recruitment_experience }}</span></li>
                            <li>{{trans('admin-auth.deadline')}}: <span>{{ date('H:i d/m/Y', strtotime($post->recruitment_deadline)) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="share_wrap d-flex flex-column tags_list">
                    <span>Tag:</span>
                    <ul class="py-3">
                        @if (!is_null($post->tags))
                        <form action="{{ route('posts.news.list') }}" class="d-flex flex-wrap" style="gap: 15px">
                            @foreach ($post->tags as $tag)
                            <button class="btn btn-secondary" type="submit" name="tag" value="{{ $tag->tag_key }}">
                                {{ $tag->tag_name }}
                            </button>
                            @endforeach
                        </form>
                        @else
                        <li>No tags</li>
                        @endif
                    </ul>
                </div> -->
                @if (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Candidate)
                <div id="apply_job">
                    <div class="apply_job_form white-bg">
                        <h4>{{trans('all-jobs.apply_for')}}</h4>
                        <form action="{{ route('job_apply.apply') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="fullname">{{trans('admin-auth.full_name')}}</label>
                                        <input type="text" placeholder="{{trans('admin-auth.full_name')}}" name="fullname" id="fullname" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 20px;">
                                    <div class="select_field">
                                        <label for="gender">{{trans('admin-auth.gender')}}</label>
                                        <select name="gender" id="gender" class="w-100" style="height: 60px;" required>
                                            <option value="Male" {{ Auth::check() && Auth::user()->gender == 'Male' ? 'selected' : '' }}>
                                            {{trans('admin-auth.male')}}
                                            </option>
                                            <option value="Female" {{ Auth::check() && Auth::user()->gender == 'Female' ? 'selected' : '' }}>
                                            {{trans('admin-auth.female')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="email">{{trans('admin-auth.email')}}</label>
                                        <input type="text" placeholder="{{trans('admin-auth.email')}}" name="email" id="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="phone">{{trans('admin-auth.phone')}}</label>
                                        <input type="text" placeholder="{{trans('admin-auth.phone')}}" name="phone" id="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="address">{{trans('admin-auth.address')}}</label>
                                        <input type="text" placeholder="{{trans('admin-auth.address')}}" name="address" id="address" value="{{ Auth::check() ? Auth::user()->address : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="birthday">{{trans('admin-auth.birthday')}}</label>
                                        <input type="date" placeholder="{{trans('admin-auth.birthday')}}" name="birthday" id="birthday" value="{{ Auth::check() ? date('Y-m-d', strtotime(Auth::user()->birthday)) : date('Y-m-d', strtotime(now())) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">{{trans('all-jobs.cv_file')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="attachment" accept=".pdf,.doc,.docx,image/*">
                                            <label class="custom-file-label" for="inputGroupFile03">{{trans('all-jobs.upload_cv')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <label for="">{{trans('all-jobs.note')}}</label>
                                        <textarea name="candidate_note" id="candidate_note" cols="30" rows="10" placeholder="{{trans('all-jobs.note')}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">{{trans('all-jobs.apply_now')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
@extends('frontend.master.master')

@section('css')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag --------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text ">
                        <h3 class="text-uppercase text-dark">{{ __('profile.profile') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <hr>
    <div class="container bootstrap snippet my-5 py-5">
        <div class="row py-5">
            <div class="col-sm-10">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!--left col-->

                <div class="text-center">
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar img-circle img-thumbnail"
                        alt="avatar" style="width:250px; height:250px !important" id="uploadedAvatar">
                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <h6>{{ __('profile.upload-a-different-photo') }}</h6>
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">{{ __('profile.upload-new-photo') }}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>

                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">{{ __('profile.reset') }}</span>
                            </button>
                        </div>
                    @endif
                </div>

            </div>
            <!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">{{ __('profile.profile') }}</a></li>
                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <li><a data-toggle="tab" href="#post-favorite">{{ __('profile.post-favorite') }}</a></li>
                    @endif
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <div class="my-5">
                                <form id="form-update-profile" method="POST" action="{{ route('profile.update', $user) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="upload"
                                        class="account-file-input text-center center-block file-upload" hidden
                                        accept="image/png, image/jpeg" name="avatar" />
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">{{ __('profile.phone') }}</label>
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                value="{{ $user->phone }}" readonly />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">{{ __('profile.email') }}</label>
                                            <input class="form-control" readonly type="text" id="email"
                                                name="email" value="{{ $user->email }}" placeholder="{{ __('profile.email') }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="fullname" class="form-label">{{ __('profile.fullname') }}</label>
                                            <input class="form-control" type="text" id="fullname" name="name"
                                                value="{{ $user->name }}" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="gender" class="form-label">{{ __('profile.gender') }}</label>
                                            <select id="gender" name="gender" class="select2 form-select">
                                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>{{ __('profile.male') }}
                                                </option>
                                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                    {{ __('profile.female') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">{{ __('profile.address') }}</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $user->address }}" placeholder="{{ __('profile.address') }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="birthday" class="form-label">{{ __('profile.birthday') }}</label>
                                            <input class="form-control" type="date" id="birthday" name="birthday"
                                                placeholder="dd/mm/yyyy"
                                                value={{ date('Y-m-d', strtotime($user->birthday)) }} />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" form="form-update-profile"
                                            class="btn btn-primary me-2">{{ __('profile.save-changes') }}</button>
                                        <button type="reset" class="btn btn-outline-secondary">{{ __('profile.reset') }}</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="my-5">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.fullname') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.gender') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->gender == 'Male' ? __('profile.male') : __('profile.female') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.birthday') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ date('d/m/Y', strtotime($user->birthday)) }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.birthday') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.phone') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.address') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <!--/tab-pane-->
                        <div class="tab-pane" id="post-favorite">
                            <div class="job_listing_area plus_padding">
                                <div class="container" style="width: 100% !important;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="job_lists m-0">
                                                <div class="row" id="paginated-list" data-current-page="1"
                                                    aria-live="polite">
                                                    @if (count($posts) > 0)
                                                        @foreach ($posts as $post)
                                                            <li class="col-lg-12 col-md-12 item_list_jobs">
                                                                <div
                                                                    class="single_jobs white-bg d-flex justify-content-between">
                                                                    <div class="jobs_left d-flex align-items-center col-8">
                                                                        <div class="thumb">
                                                                            <img src="{{ asset('storage/' . $post->post_image) }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="jobs_conetent">
                                                                            <a
                                                                                href="{{ route('posts.recruitment.details', $post->id) }}">
                                                                                <h4 class="job-title-item">
                                                                                    {{ $post->post_title }}</h4>
                                                                            </a>
                                                                            <div>
                                                                                <h6> {{ $post->author }}</h6>
                                                                            </div>
                                                                            <div class="links_locat d-flex align-items-center"
                                                                                style="gap: 28px;">
                                                                                <div class="location">
                                                                                    <p class="address"> <i
                                                                                            class="fa fa-map-marker"></i>
                                                                                        {{ $post->recruitment_address }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="location">
                                                                                    <p> <i class="fa fa-clock-o"></i>
                                                                                        {{ $post->recruitment_job_nature }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="location">
                                                                                    <p> <i class="fa fa-eye"></i>
                                                                                        {{ $post->post_view }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="jobs_right">
                                                                        <div class="apply_now">
                                                                            @if (Auth::check())
                                                                                <a class="heart_mark"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="change_favotire({{ $post->id }},{{ Auth::user()->id }}, this)">
                                                                                    @if (Auth::user()->is_post_favorite($post->id))
                                                                                        <i class="fa fa-heart"></i>
                                                                                    @else
                                                                                        <i class="ti-heart"></i>
                                                                                    @endif
                                                                                </a>
                                                                            @endif
                                                                            <a href="{{ route('posts.recruitment.details', $post->id) }}/#apply_job"
                                                                                class="boxed-btn3">Apply Now</a>
                                                                        </div>
                                                                        <div class="date">
                                                                            <p>Deadline:
                                                                                {{ $post->recruitment_deadline ? date('H:i d/m/Y', strtotime($post->recruitment_deadline)) : 'None' }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <h3>Not found post</h3>
                                                    @endif

                                                </div>

                                                @if (count($posts) > 0)
                                                    <nav class="pagination-container">
                                                        <button class="pagination-button" id="prev-button"
                                                            aria-label="Previous page" title="Previous page">
                                                            &lt;
                                                        </button>

                                                        <div id="pagination-numbers">

                                                        </div>

                                                        <button class="pagination-button" id="next-button"
                                                            aria-label="Next page" title="Next page">
                                                            &gt;
                                                        </button>
                                                    </nav>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
@endsection

@section('js')
    <script>
        const paginationNumbers = document.getElementById("pagination-numbers");
        const paginatedList = document.getElementById("paginated-list");
        const listItems = paginatedList.querySelectorAll("li");
        const nextButton = document.getElementById("next-button");
        const prevButton = document.getElementById("prev-button");

        const paginationLimit = 5;
        const pageCount = Math.ceil(listItems.length / paginationLimit);
        let currentPage = 1;

        const disableButton = (button) => {
            button.classList.add("disabled");
            button.setAttribute("disabled", true);
        };

        const enableButton = (button) => {
            button.classList.remove("disabled");
            button.removeAttribute("disabled");
        };

        const handlePageButtonsStatus = () => {
            if (currentPage === 1) {
                disableButton(prevButton);
            } else {
                enableButton(prevButton);
            }

            if (pageCount === currentPage) {
                disableButton(nextButton);
            } else {
                enableButton(nextButton);
            }
        };

        const handleActivePageNumber = () => {
            document.querySelectorAll(".pagination-number").forEach((button) => {
                button.classList.remove("active");
                const pageIndex = Number(button.getAttribute("page-index"));
                if (pageIndex == currentPage) {
                    button.classList.add("active");
                }
            });
        };

        const appendPageNumber = (index) => {
            const pageNumber = document.createElement("button");
            pageNumber.className = "pagination-number";
            pageNumber.innerHTML = index;
            pageNumber.setAttribute("page-index", index);
            pageNumber.setAttribute("aria-label", "Page " + index);

            paginationNumbers.appendChild(pageNumber);
        };

        const getPaginationNumbers = () => {
            for (let i = 1; i <= pageCount; i++) {
                appendPageNumber(i);
            }
        };

        const setCurrentPage = (pageNum) => {
            currentPage = pageNum;

            handleActivePageNumber();
            handlePageButtonsStatus();

            const prevRange = (pageNum - 1) * paginationLimit;
            const currRange = pageNum * paginationLimit;

            listItems.forEach((item, index) => {
                item.classList.add("hidden");
                if (index >= prevRange && index < currRange) {
                    item.classList.remove("hidden");
                }
            });
        };

        window.addEventListener("load", () => {
            getPaginationNumbers();
            setCurrentPage(1);

            prevButton.addEventListener("click", () => {
                setCurrentPage(currentPage - 1);
            });

            nextButton.addEventListener("click", () => {
                setCurrentPage(currentPage + 1);
            });

            document.querySelectorAll(".pagination-number").forEach((button) => {
                const pageIndex = Number(button.getAttribute("page-index"));

                if (pageIndex) {
                    button.addEventListener("click", () => {
                        setCurrentPage(pageIndex);
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
    </script>
@endsection

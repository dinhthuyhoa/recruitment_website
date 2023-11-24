
@extends('frontend.master.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $count_post }} {{trans('all-jobs.title_banner_jobs')}}</h3>
                        <p>{{trans('all-jobs.description_all_jobs_1')}}
                        <br>
                        {{trans('all-jobs.description_all_jobs_2')}}
                        <br>
                        {{trans('all-jobs.description_all_jobs_3')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 style="font-weight: bold;">{{trans('all-jobs.job_listings')}}</h4>

                                    @if (isset(request()->keyword))
                                        <p>
                                            {{ count($posts) }} result by keyword <b>{{ request()->keyword }}</b>
                                        </p>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="serch_cat d-flex justify-content-end">
                                        <form action="{{ route('posts.recruitment.list') }}" id="form_search_job"
                                            class="d-flex" method="get">
                                            <div class="input-group">
                                                <div class="form-outline mr-3">
                                                    <input type="search" id="keyword" name="keyword" class="form-control"
                                                        value="{{ request()->keyword }}" style="border: 1.5px #020c26 solid" placeholder="{{trans('all-jobs.search_jobs')}}"/>
                                                </div>
                                                <button type="submit" form="form_search_job" class="btn" style="background-color: #ffa500;">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-3">
                        <form action="" class="d-flex flex-wrap" style="gap: 15px">
                            @foreach ($tags as $tag)
                                @if (isset(request()->tag) && request()->tag == $tag->tag_key)
                                    <button class="btn btn-orange-checked" type="submit" name="tag"
                                        value="{{ $tag->tag_key }}">
                                        {{ $tag->tag_name }}
                                    </button>
                                @else
                                    <button class="btn btn-orange" type="submit" name="tag"
                                        value="{{ $tag->tag_key }}">
                                        {{ $tag->tag_name }}
                                    </button>
                                @endif
                            @endforeach
                        </form>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row" id="paginated-list" data-current-page="1" aria-live="polite">
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <li class="col-lg-12 col-md-12 item_list_jobs">
                                        <div class="single_jobs white-bg d-flex justify-content-between">
                                            <div class="jobs_left d-flex align-items-center col-8">
                                                <div class="thumb">
                                                    <img src="{{ asset('storage/' . $post->post_image) }}" alt="">
                                                </div>
                                                <div class="jobs_conetent">
                                                    <a href="{{ route('posts.recruitment.details', $post->id) }}">
                                                        <h4 class="job-title-item">{{ $post->post_title }}</h4>
                                                    </a>
                                                    <div>
                                                        <h6> {{ $post->author }}</h6>
                                                    </div>
                                                    <div class="links_locat d-flex" style="gap: 20px;">
                                                        <div class="location">
                                                            <p class="address"> <i class="fa fa-map-marker"></i>
                                                                {{ $post->recruitment_address }}</p>
                                                        </div>
                                                        <div class="location" style="width:150px">
                                                            <p> <i class="fa fa-clock-o"></i>
                                                                {{ $post->recruitment_job_nature }}</p>
                                                        </div>
                                                        <div class="location" style="width:100px">
                                                            <p> <i class="fa fa-eye"></i>
                                                                {{ $post->post_view }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jobs_right">
                                                <div class="apply_now">
                                                    @if (Auth::check())
                                                        <a class="heart_mark" href="javascript:void(0);"
                                                            onclick="change_favotire({{ $post->id }},{{ Auth::user()->id }}, this)">
                                                            @if (Auth::user()->is_post_favorite($post->id))
                                                                <i class="fa fa-heart"></i>
                                                            @else
                                                                <i class="ti-heart"></i>
                                                            @endif
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('posts.recruitment.details', $post->id) }}/#apply_job"
                                                        class="boxed-btn3 apply-job" >{{trans('all-jobs.apply_now')}}</a>
                                                </div>
                                                <div class="date">
                                                    <p>{{trans('all-jobs.deadline')}}
                                                        {{ $post->recruitment_deadline ? date('H:i d/m/Y', strtotime($post->recruitment_deadline)) : 'None' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <h3 class="mx-3">{{trans('all-jobs.not_found')}}</h3>
                            @endif

                        </div>

                        @if (count($posts) > 5)
                            <nav class="pagination-container">
                                <button class="pagination-button text-white" id="prev-button" aria-label="Previous page"
                                    title="Previous page">
                                    &lt;
                                </button>

                                <div id="pagination-numbers">

                                </div>

                                <button class="pagination-button text-white" id="next-button" aria-label="Next page"
                                    title="Next page">
                                    &gt;
                                </button>
                            </nav>
                        @endif

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3 style="font-weight: bold;">{{trans('all-jobs.filter')}}</h3>
                            <form action="{{ route('posts.recruitment.list') }}" id="form_filter_jobs" method="get">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field" >
                                            <label for="filter_address" style="font-size:15px; color:#020c26">{{trans('all-jobs.location')}}</label>
                                            <select class="wide" name="filter_address" id="filter_address"style="width: 200px; border: 1px solid #020c26 !important;">
                                                <option value="">{{trans('all-jobs.all')}}</option>
                                                @foreach (config('63-tinh-vn') as $k => $v)
                                                    <option value="{{ $k }}"
                                                        {{ request()->filter_address == $k ? 'selected' : '' }}>
                                                        {{ $v }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label for="filter_job_nature" class=" mt-3" style="font-size:15px; color:#020c26">{{trans('all-jobs.job_nature')}}</label>
                                            <select class="wide select-tinh-tp" name="filter_job_nature"
                                                id="filter_job_nature">
                                                <option value="">{{trans('all-jobs.all')}}</option>
                                                <option value="Full time"
                                                    {{ request()->filter_job_nature == 'Full-time' ? 'selected' : '' }}>
                                                    {{trans('all-jobs.full_time')}}
                                                </option>
                                                <option value="Part time"
                                                    {{ request()->filter_job_nature == 'Part-time' ? 'selected' : '' }}>
                                                    {{trans('all-jobs.part_time')}}
                                                </option>
                                                <option value="Freelancer"
                                                    {{ request()->filter_job_nature == 'Freelancer' ? 'selected' : '' }}>
                                                    {{trans('all-jobs.freelancer')}}
                                                </option>
                                            </select>

                                            <script>
                                                $('#filter_address').select2();
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="reset_btn col-12">
                                    <button class="boxed-btn3 w-100 mb-3 filter-job" form="form_filter_jobs"
                                        type="submit">{{trans('all-jobs.filter')}}</button>
                                    <a href="{{ route('posts.recruitment.list') }}" class="boxed-btn3 w-100 reset-job"
                                        type="submit">{{trans('all-jobs.reset')}}</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

    <div class="inner-left preview" id="demo">

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
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 100000,
                values: [0, 100000],
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1] + "/ Month");
                }
            });
            $("#filter_salary_start").val($("#slider-range").slider("values", 0));
            $("#filter_salary_end").val($("#slider-range").slider("values", 1));

            $("#amount").val($("#slider-range").slider("values", 0) +
                " VND - " + $("#slider-range").slider("values", 1) + " VND/ Month");
        });
    </script>
@endsection

@extends('frontend.master.master')
@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        .hidden {
            display: none;
        }

        .pagination-container {
            width: calc(100% - 2rem);
            display: flex;
            align-items: center;
            bottom: 0;
            padding: 1rem 0;
            justify-content: center;
        }

        .pagination-number,
        .pagination-button {
            font-size: 1.1rem;
            background-color: transparent;
            border: none;
            margin: 0.25rem 0.25rem;
            cursor: pointer;
            height: 2.5rem;
            width: 2.5rem;
            border-radius: .2rem;
        }

        .pagination-number:hover,
        .pagination-button:not(.disabled):hover {
            background: #fff;
        }

        .pagination-number.active {
            color: #fff;
            background: var(--orange);
        }
    </style>
@endsection
@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $count_post - 1 }}+ Jobs Available</h3>
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
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filter</h3>
                            <form action="{{ route('posts.recruitment.list') }}" id="form_filter_jobs" method="get">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label for="filter_address">Location</label>
                                            <select class="wide" name="filter_address" id="filter_address">
                                                <option value="">All</option>
                                                <option value="Can Tho"
                                                    {{ request()->filter_address == 'Can Tho' ? 'selected' : '' }}>Cần Thơ
                                                </option>
                                                <option value="HCM"
                                                    {{ request()->filter_address == 'HCM' ? 'selected' : '' }}>Sài Gòn
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label for="filter_job_nature">Job nature</label>
                                            <select class="wide" name="filter_job_nature" id="filter_job_nature">
                                                <option value="">All</option>
                                                <option value="Full-time"
                                                    {{ request()->filter_job_nature == 'Full-time' ? 'selected' : '' }}>Full
                                                    time
                                                </option>
                                                <option value="Part-time"
                                                    {{ request()->filter_job_nature == 'Part-time' ? 'selected' : '' }}>Part
                                                    time
                                                </option>
                                                <option value="Freelancer"
                                                    {{ request()->filter_job_nature == 'Freelancer' ? 'selected' : '' }}>
                                                    Freelancer
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="reset_btn col-12">
                                    <button class="boxed-btn3 w-100 mb-3" form="form_filter_jobs"
                                        type="submit">Filter</button>
                                    <a href="{{ route('posts.recruitment.list') }}" class="boxed-btn3 w-100"
                                        type="submit">Reset</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Job Listing</h4>

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
                                                        value="{{ request()->keyword }}" />
                                                </div>
                                                <button type="submit" form="form_search_job" class="btn btn-primary">
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
                                    <button class="btn btn-primary" type="submit" name="tag"
                                        value="{{ $tag->tag_key }}">
                                        {{ $tag->tag_name }}
                                    </button>
                                @else
                                    <button class="btn btn-info" type="submit" name="tag" value="{{ $tag->tag_key }}">
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
                                                        <h4>{{ $post->post_title }}</h4>
                                                    </a>
                                                    <div>
                                                        <h6> {{ $post->author }}</h6>
                                                    </div>
                                                    <div class="links_locat d-flex align-items-center" style="gap: 28px;">
                                                        <div class="location">
                                                            <p class="address"> <i class="fa fa-map-marker"></i>
                                                                {{ $post->recruitment_address }}</p>
                                                        </div>
                                                        <div class="location">
                                                            <p> <i class="fa fa-clock-o"></i>
                                                                {{ $post->recruitment_job_nature }}</p>
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

                        <nav class="pagination-container">
                            <button class="pagination-button" id="prev-button" aria-label="Previous page"
                                title="Previous page">
                                &lt;
                            </button>

                            <div id="pagination-numbers">

                            </div>

                            <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                                &gt;
                            </button>
                        </nav>

                        <div class="row">
                            <div class="col-lg-12">
                            </div>
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

@extends('frontend.master.master')

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{trans('all-jobs.title_banner_news')}}</h3>
                        <p>
                            {{trans('all-jobs.description_all_news_1')}}
                            <br>
                            {{trans('all-jobs.description_all_news_2')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!--================Blog Area =================-->
    <section class="blog_area section-padding job_listing_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 mb-5 mb-lg-0 job-list px-5">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 style="font-weight: bold;">{{trans('all-jobs.news_listings')}}</h4>
                                </div>
                                <div class="col-md-6">
                                    <aside class="single_sidebar_widget search_widget">
                                        <form action="#" id="form-search-news">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="search" class="form-control" placeholder="{{trans('all-jobs.search_jobs')}}"
                                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search By Keyword'"
                                                        id="keyword" name="keyword" class="form-control"
                                                        value="{{ request()->keyword }}" style="border: 1.5px #020c26 solid">

                                                    <div class="input-group-append mx-2">
                                                        <button class="btn" type="submmit" form="form-search-news" style="background-color: #ffa500;"><i
                                                                class="ti-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn filter-job" type="submit"
                                                form="form-search-news">Search</button> -->
                                        </form>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog_left_sidebar" id="paginated-list-news" data-current-page="1" aria-live="polite">
                        <div class="row px-3" id="paginated-list">
                            @if (count($posts) > 0)
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($posts as $post)
                                    @if ($counter % 6 == 0)
                                        @if ($counter > 0)
                                            </div>
                                        @endif
                                        <div class="row">
                                    @endif
                                    <div class="col-lg-4 col-md-4 item_list_jobs">
                                        <div class="blog_item">
                                            <div class="blog_item_img">
                                                <img class="card-img rounded-0" src="{{ asset('storage/' . $post->post_image) }}" alt="">
                                                <span class="blog_item_date">
                                                    <h3>{{ date('d', strtotime($post->created_at)) }}</h3>
                                                    <p>{{ date('F', strtotime($post->created_at)) }}</p>
                                                    <p>{{ date('Y', strtotime($post->created_at)) }}</p>
                                                </span>
                                            </div>
                                            <div class="blog_details">
                                                <a class="d-inline-block" href="{{ route('posts.news.details', $post->id) }}">
                                                    <h2>{{ $post->post_title }}</h2>
                                                </a>
                                                <p class="post-description">{{ $post->post_description }}</p>
                                                <ul class="blog-info-link">
                                                    <li><span><i class="fa fa-user"></i> {{ $post->author }}</span></li>
                                                    <li><span><i class="fa fa-comments"></i> {{ count($post->comments) }} {{trans('comment.comment')}}</span></li>
                                                    <li><span><i class="fa fa-eye"></i> {{ $post->post_view }} {{trans('comment.view')}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
                                </div> <!-- Close the last row -->
                            @else
                                <h3 class="mx-3">{{trans('all-jobs.not_found')}}</h3>
                            @endif
                        </div>
                        @if (count($posts) > 6)
                            <nav class="pagination-container">
                                <button class="pagination-button text-black" id="prev-button" aria-label="Previous page" title="Previous page">
                                    &lt;
                                </button>
                                <div id="pagination-numbers"></div>
                                <button class="pagination-button text-black" id="next-button" aria-label="Next page" title="Next page">
                                    &gt;
                                </button>
                            </nav>
                        @endif
                    </div>
                </div>

                <!-- <div class="col-lg-2">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">{{trans('all-jobs.tag')}}</h4>
                            <ul class="list">
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
                            </ul>
                        </aside>
                    </div>
                </div> -->
                <div class="col-lg-2">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3 style="font-weight: bold;">{{ trans('admin-auth.category') }}</h3>
                            <form action="{{ route('posts.news.list') }}" id="form_filter_news" method="get">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <button class="btn btn-orange-checked w-100 my-1 bg-secondary" type="submit" name="post_category" value="Su-kien">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <p class="my-1">{{trans('admin-auth.su_kien')}}</p>
                                                
                                            </button>
                                            <button class="btn btn-orange-checked w-100 my-1 bg-warning bg-gradient" type="submit" name="post_category" value="Hoc-bong">
                                                <i class="fa-solid fa-hands-holding-circle"></i>
                                                <p class="my-1">{{trans('admin-auth.hoc_bong')}}</p>
                                                
                                            </button>
                                            <button class="btn btn-orange-checked w-100 my-1" type="submit" name="post_category" value="Cuoc-thi">
                                                <i class="fa-solid fa-cubes"></i>
                                                <p class="my-1">{{trans('admin-auth.cuoc_thi')}}</p>
                                                
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <div class="inner-left preview" id="demo">

    </div>
@endsection

@section('js')
<script>
    const paginatedList = document.getElementById("paginated-list");
    const listItems = paginatedList.querySelectorAll(".item_list_jobs");
    const nextButton = document.getElementById("next-button");
    const prevButton = document.getElementById("prev-button");
    const paginationNumbers = document.getElementById("pagination-numbers");

    const itemsPerPage = 6;
    const pageCount = Math.ceil(listItems.length / itemsPerPage);
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

        const startIndex = (pageNum - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        listItems.forEach((item, index) => {
            item.style.display = (index >= startIndex && index < endIndex) ? "block" : "none";
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



@endsection

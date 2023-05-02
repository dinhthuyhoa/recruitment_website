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
                        <h3>NEWS</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar" id="paginated-list-news" data-current-page="1" aria-live="polite">

                        <div class="row" id="paginated-list" data-current-page="1" aria-live="polite">
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <li class="col-lg-12 col-md-12 item_list_jobs">
                                        <div class="blog_item">
                                            <div class="blog_item_img">
                                                <img class="card-img rounded-0"
                                                    src="{{ asset('storage/' . $post->post_image) }}" alt="">
                                                <span class="blog_item_date">
                                                    <h3>{{ date('d', strtotime($post->created_at)) }}</h3>
                                                    <p>{{ date('F', strtotime($post->created_at)) }}</p>
                                                    <p>{{ date('Y', strtotime($post->created_at)) }}</p>
                                                </span>
                                            </div>

                                            <div class="blog_details">
                                                <a class="d-inline-block"
                                                    href="{{ route('posts.news.details', $post->id) }}">
                                                    <h2>{{ $post->post_title }}</h2>
                                                </a>
                                                <p class="post-description">{{ $post->post_description }}</p>
                                                <ul class="blog-info-link">
                                                    <li><span><i class="fa fa-user"></i> {{ $post->author }}</span></li>
                                                    <li><span><i class="fa fa-comments"></i> {{ count($post->comments) }}
                                                            Comments</span></li>
                                                    <li><span><i class="fa fa-eye"></i> {{ $post->post_view }} View</span>
                                                    </li>
                                                </ul>
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
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#" id="form-search-news">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="search" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'"
                                            id="keyword" name="keyword" class="form-control"
                                            value="{{ request()->keyword }}">

                                        <div class="input-group-append">
                                            <button class="btn" type="submmit" form="form-search-news"><i
                                                    class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit"
                                    form="form-search-news">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
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
        const paginationNumbers = document.getElementById("pagination-numbers");
        const paginatedList = document.getElementById("paginated-list-news");
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

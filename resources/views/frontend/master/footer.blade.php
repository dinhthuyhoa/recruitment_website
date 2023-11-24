<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="footer_logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('logo-flower.png') }}" alt="" style="width: 200px; height: 200px">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-lg-2">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                        <h3 class="footer_title">
                            {{trans('footer.recruitment_portal')}}
                        </h3>
                        <ul>
                            <li><a href="{{route('home')}}">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.about_us')}}</a></li>
                            @if(Auth::check() && Auth::user()->role != 'recruiter')
                                <li><a href="{{route('posts.recruitment.list')}}">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.list_job')}}</a></li>
                            @endif
                            <li><a href="{{route('posts.news.list')}}">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.news')}}</a></li>
                            <li><a href="{{route('contact')}}">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.contact')}}</a></li>
                        </ul>

                    </div>
                </div>
                @if(Auth::check() && Auth::user()->role != 'recruiter')
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">{{trans('footer.utilities')}}</h3>
                            <ul>
                                <li><a href="{{route('posts.recruitment.list')}}">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.find_a_job')}}</a></li>
                                <li><a href="#">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.cv')}}</a></li>
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-xl-5 col-md-6 col-lg-4">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                        <h3 class="footer_title">
                        {{trans('footer.title_contact')}}
                        </h3>
                        <ul>
                            <li><p style="color: #D8DCE4 !important;">{{trans('footer.address_1')}}</p></li>
                            <li><a href="#">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.address_2')}}</a></li>
                            <li><a href="#">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.number_contact')}}</a></li>
                            <li><a href="#">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.fax')}}</a></li>
                            <li><a href="#">|&nbsp;&nbsp;&nbsp;&nbsp;{{trans('footer.email')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s" style="border: 1px solid #020c26;">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <p class="copy_right text-center" style="color: #020c26 !important;">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        {{trans('footer.copyright')}} &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        {{trans('footer.my_name')}}
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

@extends('frontend.master.master')

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{trans('all-jobs.title_contact')}}</h3>
                        <p>
                        {{trans('all-jobs.description_contact_1')}}
                        <br>
                        {{trans('all-jobs.description_contact_2')}}
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--/ bradcam_area  -->
    <!-- ================ contact section start ================= -->
    <section class="contact-section section_padding">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                
                <div id="map" style="height: 480px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d491.10399956050304!2d105.76916480868296!3d10.030718788141185!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883d2192b0f1%3A0x4c90a391d232ccce!2zVHLGsOG7nW5nIEPDtG5nIE5naOG7hyBUaMO0bmcgVGluIHbDoCBUcnV54buBbiBUaMO0bmcgKENUVSk!5e0!3m2!1svi!2s!4v1682228457481!5m2!1svi!2s"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">                        {{trans('all-jobs.title_contact_2')}}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                        novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">

                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="                       {{trans('all-jobs.message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                        placeholder="                       {{trans('all-jobs.your_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                        placeholder="                       {{trans('all-jobs.your_email')}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                        placeholder="                       {{trans('all-jobs.your_subject')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn" style="">
                            {{trans('all-jobs.send_message')}}
                        </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home text-dark"></i></span>
                        <div class="media-body">
                            <h3>{{trans('all-jobs.ddress')}}</h3>
                            <p class="text-white">{{trans('all-jobs.note_address')}}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet text-dark"></i></span>
                        <div class="media-body">
                            <h3>{{trans('all-jobs.number_phone')}}</h3>
                            <p class="text-white">{{trans('all-jobs.notes')}}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-printer text-dark"></i></span>
                        <div class="media-body">
                            <h3>{{trans('all-jobs.fax')}}</h3>
                            <p class="text-white">{{trans('all-jobs.notes')}}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email text-dark"></i></span>
                        <div class="media-body">
                            <h3>{{trans('all-jobs.email')}}</h3>
                            <p class="text-white">{{trans('all-jobs.notes')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection

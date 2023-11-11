@extends('frontend.master.master')
@section('css')
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft" >Job Posting</h5>
                        <h3 class="wow fadeInLeft" >And Effective Candidate Search</h3>
                        <p class="wow fadeInLeft" style="font-size: 24px;">We provide online recruitment information with swift, reliable, and accurate approvals.</p>
                        <div class="sldier_btn wow fadeInLeft" >
                            <a href="{{route('posts.recruitment.list')}}" class="boxed-btn3" style="background-color: #c07f00; border: 1px solid #c07f00">Find Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_3">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #c07f00;">| Big Upgrade</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">We are harnessing the power of information technology to build a robust bridge between <br>the student community and businesses. Our system not only facilitates students in easily searching and connecting with job opportunities that align with their skills and interests but also provides comprehensive solutions for the challenges that businesses encounter in the recruitment process.
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        Simultaneously, businesses can benefit from accessing a diverse and high-quality pool of candidates, thanks to the intelligent interaction capabilities on our platform. In this way, we are supporting not only the job search process but also the development and optimization of human resources for enterprises, creating a win-win environment for both students and businesses.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<!-- slider_area_end -->

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">| New Feature. A Fresh Experience!</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">Recruitment Portal, a product of cutting-edge information technology, is meticulously designed to revolutionize the hiring process. By leveraging advanced data analytics, the portal thoroughly examines the requirements, habits, and behaviors of both recruiters and candidates. This comprehensive analysis serves as the foundation for generating insightful predictions and strategic recommendations aimed at optimizing recruitment practices.
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        Moreover, the Recruitment Portal acts as an intelligent advisor, offering real-time feedback and performance metrics. It empowers recruiters to make data-driven decisions, ultimately streamlining the hiring process and ensuring a more precise alignment between talent acquisition strategies and organizational objectives. With its forward-thinking features, this portal represents a leap forward in the realm of recruitment technology, promising a future where every hiring decision is informed, efficient, and tailored to the unique dynamics of each business.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">| About us</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">The College of Information and Communication Technology is honored to be one of the seven faculties/schools pioneering in Vietnam, responsible for training engineers since 1990. With 33 years of construction and development, The College of Information and Communication Technology brand has become a prestigious institution providing high-quality human resources for the domestic and international labor markets. The school's mission is to train engineers, masters, and doctors specializing in the field of IT and related fields, actively contributing to the development of Vietnam's information technology industry; simultaneously conducting scientific research and transferring advanced technology to promote the industrialization and modernization of the country.

                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        
                        The College of Information and Communication Technology consists of 6 departments and 4 affiliated units. Each department is responsible for training in specific majors and specializations. In terms of training scale, the school is currently responsible for training 10 majors and specializations at the bachelor's level, 3 majors at the master's level, and 1 major at the doctoral level, with a total enrollment of over 5,000 students. Regarding the faculty, the school currently has 123 staff members (104 teaching staff and 19 support/service staff), including 5 associate professors, 46 doctors, and 58 masters. The majority of the faculty members have been trained at advanced universities abroad.

                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                            
                        In the context of the digital transformation and the fourth industrial revolution, the school has consistently focused on enhancing development in all aspects, both in terms of quality and scale. The College of Information and Communication Technology possesses modern facilities and a strong and comprehensive faculty. Particularly in recent years, The College of Information and Communication Technology has been honored with prestigious awards such as the Emulation Flag and Commendation Certificate from the Ministry of Education and Training, the Commendation Certificate from the Prime Minister, and the Labor Order from the President.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_6">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">| Mission and vision</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">The College of Information and Communication Technology is to provide education, conduct scientific research, and transfer technology in the field of IT and Communication, as well as related areas, to serve the industrialization and modernization of the country.<br>
                        Looking towards 2030, the ITC aspires to become a strong and reputable university in the field of IT and Communication in the Asian region, achieving international standards for quality assurance in education.
                        <br>
                        The core values of the ITC are "Consensus - Devontion - Quality - Innovation."
                        <br>
                        The educational philosophy of The College of Information and Communication Technology is "Critical Thinking, Creativity, with the learner at the center."
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="slider">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="top_companies_area">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-lg-12 col-md-6">
                <div class="section_title">
                <h5 class="fw-bold" style="font-size: 30px; color: #010624;">| Overview Of Collaboration</h5>
                <p class="text-white" style="font-size: 14px;">
                    The College of Information and Communication Technology consistently emphasizes strengthening collaborative relationships with traditional partners from France and Canada, while actively expanding cooperation with new partners from the UK, the US, Australia, and Asia. In addition, the school proactively seeks, deploys, and successfully executes various international projects, providing many opportunities for faculty and students to study/research abroad.
                    <br>
                    The College of Information and Communication Technology collaborates with numerous software companies to train students in specialized skills and develop software products. The school also engages in extensive collaboration with many provinces and cities in Vietnam, both in the digital transformation initiatives and in research and development of software products. In addition to hundreds of Memoranda of Understanding (MoUs) signed at the university level in Can Tho, The College of Information and Communication Technology has signed MoUs with over 50 companies, both domestic and international. Annually, the school reviews and evaluates the signed MoUs to develop specific plans, further enhancing collaborative relationships with partners.
                    <br>
                    This efficient bridge-building between the university and the business sector contributes to elevating the university's brand. Through these activities, the school receives substantial sponsorship from companies, ranging from scholarships for students to research equipment.
                </p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-40">
            <div class="col-lg-12 col-md-6">
                <div class="section_title">
                    <h5 class="fw-bold" style="font-size: 30px; color: #010624;">| Some prominent partners</h5>
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_7">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
@endsection
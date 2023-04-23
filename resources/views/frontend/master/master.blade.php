<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @include('frontend.master.head')
    @yield('css')
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    @include('frontend.master.header')
    <!-- header-end -->

    @if (\Session::has('success'))
        <script>
            Swal.fire(
                '',
                "{!! \Session::get('success') !!}",
                'success'
            )
        </script>
    @endif
    @if (\Session::has('error'))
        <script>
            Swal.fire(
                '',
                "{!! \Session::get('error') !!}",
                'error'
            )
        </script>
    @endif

    <!-- Start Content -->
    @yield('content')
    <!-- End Content -->

    <!-- footer start -->
    @include('frontend.master.footer')
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    @include('frontend.master.js')
    @yield('js')
</body>

</html>

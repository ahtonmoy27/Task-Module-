@include("common.head")
<body>
    <!--preloader start-->
    @include('common.preloader')
    <!--preloader end-->
    <!--sidebar section start-->
    <!--sidebar section start-->
    @include('common.sidebar')
    <!--sidebar section end--><!--sidebar section end-->

    <!--main content wrapper start-->
    <main class="tt-main-wrapper bg-secondary-subtle" id="content">

        <!--header section start-->
        @include('common.page_header')
        <!--mobile offcanvas menu start-->
        @include('common.mobile_menu')
        <!--mobile offcanvas menu end--> <!--header section end-->

        <!--page header section start-->
        {{--  --}}
        @yield('page_title')
        <!--page header section end-->

        <!-- Page Content  -->
        @yield('content')
        <!-- /Page Content  -->

        <!--footer section start-->
        @include('common.footer')
        <!--footer section end-->
    </main>
    <!--main content wrapper end-->

    <!--build:js-->
    @include('common.js')
    @stack('js')
</body>

</html>
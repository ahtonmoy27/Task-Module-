@include("common.head")
<body class="bg-light">

    <!-- Preloader -->
    @include('common.preloader')
    <!-- /Preloader -->
    @include('common.sidebar_frontend')

    <!-- Main Wrapper -->
    <div class="tt-main-wrapper d-flex flex-column min-vh-100" id="content">

        <!-- Header -->
        @include('common.frontend_page_header')
        <!-- /Header -->

        <!-- Page Title (optional section) -->
        <section class="bg-white border-bottom m-0 p-0">
            <div class="container-fluid m-0 p-0">
                @yield('page_title')
            </div>
        </section>

        <!-- Page Content -->
        <main class="flex-fill m-0 p-0">
            <div class="container-fluid m-0 p-0">
                @yield('content')
            </div>
        </main>
        <!-- /Page Content -->

        <!-- Footer -->
        @include('common.footer')
        <!-- /Footer -->
    </div>
    <!-- /Main Wrapper -->

    <!-- Scripts -->
    @include('common.js')
    @stack('js')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
@include('admin.includes.header')
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('admin.includes.topbar')


    @include('admin.includes.sidebar')

    

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        @yield('content')

    </div>
    <!-- END MAIN CONTAINER -->

    @include('admin.includes.js')
    @yield('javascript')
</body>
</html>
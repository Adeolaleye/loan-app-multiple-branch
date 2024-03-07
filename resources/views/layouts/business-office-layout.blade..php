<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
    <body>
        <div class="tap-top"><i data-feather="chevrons-up"></i></div>
        <div class="page-wrapper compact-wrapper modern-type" id="pageWrapper">
            @include('includes.navbar')
            <div class="page-body-wrapper">
                @include('includes.sidebar')
                <div class="page-body">
                    @yield('content')
                </div>
                @include('includes.footer')
            </div>
        </div>
        @include('includes.foot')
    </body>
</html>
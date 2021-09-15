<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
    <style>
        .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
            margin-top: 20px;
            margin-left: 0px;
        }
        .footer {
            margin-left: 0px;
        }
        .pill-badge-secondary {
    background-color: #f73164;
}
    </style>
    <body>
        <div class="tap-top"><i data-feather="chevrons-up"></i></div>
        <div class="page-wrapper compact-wrapper modern-type" id="pageWrapper">
            <div class=" p-10">
                <form>
                    <input type ="button" value = "Print" onclick = "window.print()" class="btn btn-secondary pull-right" />
                </form>
                <p class="f-14"><strong>Note :</strong> After clicking print, use landscape layout for best result,<br>activate background graphics at options under more settings on your print page</p>  
            </div>
            <div class="page-body-wrapper">
                <div class="page-body">
                    @yield('content')
                </div>
                @include('includes.footer')
            </div>
        </div>
        @include('includes.foot')
    </body>
</html>
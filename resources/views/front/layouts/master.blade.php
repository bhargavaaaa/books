<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('front.layouts.partials.headerscript')
    @yield('css')

</head>

<body>
    <div class="site-wrapper" id="top">
        @include('front.layouts.partials.header')

        @yield('content')

    </div>
    @include('front.layouts.partials.footer')
    @include('front.layouts.partials.footerscript')
    @yield('script')

</body>

</html>

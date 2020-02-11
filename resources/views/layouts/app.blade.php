<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $vars = get_defined_vars();
    @endphp
    <title itemtype="https://schema.org/title">@yield('page_title', \App\Helpers\Help::getPageTitle($vars))</title>
    <meta name="description" content="@yield('page_description', \App\Helpers\Help::getPageDescription($vars))">

    <!-- Scripts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css?hash=222') }}" rel="stylesheet">
   {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/web.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">--}}

{{--
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,900&display=swap" rel="stylesheet">
--}}

</head>

<body style="background-color: transparent; overflow-x: hidden">
    <div id="app" style="overflow-x: hidden">
        @include('layouts.header')
        @include('layouts.carousel')
        <main class="pb-4">
            @yield('content')
        </main>
        @include('layouts.footer')
        <message-component v-cloak></message-component>
    </div>
</body>
<script>
    var base_url = '{{url('/')}}';
    var server_locale = '{{\Illuminate\Support\Facades\App::getLocale()}}';
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
{{--
<script src="{{ asset('js/custom.js') }}" defer></script>
--}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'fc6d5e081822335a8778862a4fd806cf56887307';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
</script>
@yield('js')
</html>


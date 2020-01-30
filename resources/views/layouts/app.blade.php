<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-69307840-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-69307840-1');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $vars = get_defined_vars();
    @endphp
    <title itemtype="https://schema.org/title">{{\App\Helpers\Help::getPageTitle($vars)}}</title>
    <meta name="description" content="{{\App\Helpers\Help::getPageDescription($vars)}}">

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

        <main class="pb-4">
            @yield('content')
        </main>
        @include('layouts.footer')
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
@yield('js')
</html>

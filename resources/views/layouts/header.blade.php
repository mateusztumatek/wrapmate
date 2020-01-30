<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="w-100 text-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img itemtype="http://schema.org/Brand" class="logo" src="{{url('/storage/'.setting('site.logo'))}}">
        </a>
    </div>
    <div class="container sm-text-center">
        {{--<button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>--}}
        <button class="navbar-toggler hamburger hamburger--collapse m-auto" data-toggle="collapse" data-target="#navbarSupportedContent" type="button" onclick="hamburgerClick(this)">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{menu('home', 'bootstrap')}}
            <div class="switcher">
                <div class="language">
                    <a data-toggle="collapse" href="#language-toggle" role="button" aria-expanded="false" aria-controls="language-toggle">
                        @php
                            $locale = \Illuminate\Support\Facades\App::getLocale();
                            if($locale == 'pl') $flag = 'poland.svg';
                            if($locale == 'en') $flag = 'england.svg';
                            if($locale == 'de') $flag = 'germany.svg';
                            if(!$flag) $flag = 'poland.svg';
                        @endphp
                        <img src="{{url('/default/'.$flag)}}">
                    </a>
                    <div class="elements collapse" id="language-toggle">
                        <div class="element">
                            <a href="{{url('/')}}"><img src="{{url('/default/poland.svg')}}"></a>
                        </div>
                        <div class="element">
                            <a href="{{url('/en')}}"><img src="{{url('/default/england.svg')}}"></a>
                        </div>
                        <div class="element">
                            <a href="{{url('/de')}}"><img src="{{url('/default/germany.svg')}}"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
           {{-- <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>--}}
        </div>
    </div>
</nav>

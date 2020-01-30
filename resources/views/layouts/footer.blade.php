<div class="mt-3 w-100 footer">
    <div class="container">
        <div class="d-none">
            <span itemprop="openingHours" content="Mo,Tu,We,Th,Fr {{setting('shop.open_hours_from')}}-{{setting('shop.open_hours_to')}}"></span>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress">
              {{setting('shop.street')}}
            </span>
                <span itemprop="addressLocality">{{setting('shop.city')}}</span>,
                <span itemprop="postalCode">{{setting('shop.postal')}}</span>
            </div>
        </div>
        <div class="row">
            <div itemprop="address" class="col-md-3 mb-2" itemscope itemtype="http://schema.org/Place">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img itemtype="http://schema.org/Brand" class="logo" src="{{url('/storage/'.setting('site.logo'))}}">
                </a>
                <p><strong>Dane firmy</strong></p>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"> <span itemprop="name">Allbag Tomasz Woźniak</span><br>
                    <span itemprop="streetAddress">ul. Lwowska 87</span><br>
                    <span itemprop="postalCode">34-100</span> <span itemprop="addressLocality">Wadowice</span><br>
                    NIP: 551-250-65-44<br>
                    REGON: 120549530
                </p>
            </div>
            <div class="col-md-9">
                {!! setting('site.footer') !!}
            </div>
        </div>

        {{menu('footer', 'footer_nav')}}
        <div class="col-md-12 mt-5">
        </div>
        <div class="mt-5">
            <div class="row col-lg-3 col-md-6 col-sm-12 m-auto" style="justify-content: space-around">
                <div class="col-auto">
                    <a class="social-link" href="{{setting('site.social_fb')}}"><img src="{{url('/my_icons/facebook.png')}}" style="width: 50px"></a>
                </div>
                <div class="col-auto">
                    <a class="social-link" href="{{setting('site.social_ig')}}"><img src="{{url('/my_icons/instagram.png')}}" style="width: 50px"></a>
                </div>
                <div class="col-auto">
                    <a class="social-link" href="{{setting('site.social_pi')}}"><img src="{{url('/my_icons/pinterest.png')}}" style="width: 50px"></a>
                </div>
            </div>
        </div>
    </div>
</div>

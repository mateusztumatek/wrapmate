@php
    if(\Illuminate\Support\Facades\Request::route()->getName() == 'home'){
         $banner = \App\Po::where('type', 'home')->first();
            if($banner){
                $banner = $banner->translate(App::getLocale(), 'pl');
                $image = $banner->image;
            }
    }else{
        $banner = \App\Po::where('type', 'home')->first();
            if($banner){
                $banner->title = '';
                $banner->content = '';
                $banner->url = null;
                $image = $banner->image;
            }
    }


    if(isset($page) && $page->image) $image = $page->image;
    if(!isset($image) || !$image) $image= '/default/banner.jpg';
    if(request()->route()->getName() == 'contact'){
        $banner->title = 'Kontakt';
        $banner->content = null;
        $banner->url  = null;
    }
    if(isset($page) && $page){
        $banner->title = $page->banner_title;
        $banner->content = $page->banner_description;
        $banner->url = $page->banner_redirect;
    }
@endphp
@if(isset($banner) && $banner)
    <div data-aos="fade-in">
        <div class="banner-section @if(\Illuminate\Support\Facades\Request::route()->getName() != 'home') banner-page @endif">
            <div class="banner-holder" @if(request()->route()->getName() == 'home') style="background: rgb(254,204,65);background: radial-gradient(at 80%, rgba(254,204,65,1) 0%, rgba(250,187,1,1) 100%);" @else style="background-image: url('{{url('/storage/'.$image)}}');" @endif>
                <div class="banner-content">
                    <div class="container my-container">
                        <div class="col-md-12 px-0 d-flex align-items-center banner-content-place">
                            @if(\Illuminate\Support\Facades\Request::route()->getName() != 'creator')
                                <div class="col-sm-12 col-lg-6 text-left sm-center">
                                    <h1>{{$banner->title}}</h1>
                                    <h2>{!!  $banner->content !!}</h2>
                                    @if($banner->url)
                                        <md-button :md-ripple="false" class="md-raised my-button ml-0" href="{{url($banner->url)}}">{{__('my.Sprawdź teraz')}}</md-button>
                                        {{--<a class="btn my-button" href="{{url('/'.$banner->url)}}">Zobacz więcej</a>--}}
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Request::route()->getName() == 'home')
                        <div class="absolute-image">
                            <img src="{{url('/storage/default/autko.png')}}">
                        </div>
                    @endif
                </div>
            </div>

            {{-- <div class="col-md-6 position-relative sm-text-center">
                 <div class="w-100">
                     <div class="background-banner"></div>
                 </div>
                 <img alt="{{$banner->image}}" class="banner-image" v-lazy="''" />
             </div>--}}
        </div>
    </div>
@endif

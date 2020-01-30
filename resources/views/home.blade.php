@extends('layouts.app')

@section('content')

    @if($banner)
        <div class="give-me-space" data-aos="fade-in">
            <div class="row banner-section">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="col-12 col-lg-9 sm-text-center">
                        <h1>{{$banner->title}}</h1>
                        <h2>{!!  $banner->content !!}</h2>
                        @if($banner->url)
                            <md-button class="md-raised my-button" href="{{url('/'.$banner->url)}}">{{__('my.Dowiedz się więcej')}}</md-button>
                            <md-button class="md-raised my-button" href="http://eko-ue.pl">{{__('my.Przejdź do sklepu online')}}</md-button>

                            {{--<a class="btn my-button" href="{{url('/'.$banner->url)}}">Zobacz więcej</a>--}}
                        @endif
                    </div>
                </div>
                <div class="col-md-6 position-relative sm-text-center">
                    <div class="w-100">
                        <div class="background-banner"></div>
                    </div>
                    <img alt="{{$banner->image}}" class="banner-image" v-lazy="'{{url('/storage/'.$banner->image)}}'" />
                </div>
            </div>
        </div>
    @endif
        <configuration-component ></configuration-component>
        <colors-component :arr="{{json_encode($color_config)}}"></colors-component>

<div class="give-me-space">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 text-center s-mb-3" data-aos="fade-in">
                    <div class="image-section">
                        <img alt="{{$post->image}}" v-lazy="'{{url('/storage/'.$post->image)}}'" class="w-100">
                    </div>
                    <h3 class="my-2" style="text-transform: uppercase">{{$post->title}}</h3>
                    <p style="text-align: justify">{!! $post->content !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<info-component :post="{{json_encode($info_post)}}"></info-component>
    @if($seo = \App\Po::where('type', 'seo')->first())
        <div class="container text-center">
            <a onclick="$('#more_content').addClass('my-hidden-show')" class="md-button md-raised my-button md-theme-default"><div class="md-ripple"><div class="md-button-content">Zobacz więcej</div> </div></a>
        </div>

        <div class="my-hidden" id="more_content">
            <div class="give-me-space" data-aos="fade-in">
                <div class="container">
                    {!! $seo->content !!}
                </div>
            </div>
        </div>
    @endif
<contact-component></contact-component>
@endsection

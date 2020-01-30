@extends('layouts.app')
@section('content')
    @if($page->parent && $page->parent->title == 'Oferta handlowa')
        @include('layouts.breadcrumbs')
        @if($banner && $banner->image)
            <div class="give-me-space" data-aos="fade-in">
                <div class="row banner-section">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="col-12 col-lg-9 sm-text-center">
                            <h1>{{$banner->title}}</h1>
                            <h2>{!!  $banner->content !!}</h2>
                            @if($banner->url)
                                <md-button class="md-raised my-button" href="{{$banner->url}}">{{__('my.Dowiedz się więcej')}}</md-button>
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
    @else
        @if($page->image)
            <div class="banner">
                <img src="{{url('/storage/'.$page->image)}}" style="max-height: 600px; object-fit: contain" class="w-100">
                <div class="header">
                    <div class="content">
                        <h1>{{$page->title}}</h1>
                    </div>
                </div>
            </div>
        @endif
        @include('layouts.breadcrumbs')
    @endif
    @if($page->parent && $page->parent->title == 'Oferta handlowa')
        <configuration-component :page_id="'{{$page->id}}'"></configuration-component>
        <colors-component :page_id="{{$page->id}}"></colors-component>
    @endif
    <div class="give-me-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12 @if(strlen(strip_tags($page->content)) > 1100) description-content @endif">
                    {!! $page->content !!}
                </div>
                @if(strlen(strip_tags($page->content)) > 1100)
                <div class="col-md-12 text-center mt-3 content-toggler">
                    <md-button class="md-raised my-button" onclick="showDescription()">Zobacz więcej</md-button>
                </div>
                    @endif
            </div>
        </div>
    </div>


    @if($page->parent && $page->parent->title == 'Oferta handlowa')
        @php
            $posts = \App\Po::where('type', 'home_posts')->whereHas('pages', function ($q)use($page){
                $q->where('page_id', $page->id);
            })->get();
        @endphp
        @if($posts->count() > 0)
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
        @endif
    @endif
    @endsection

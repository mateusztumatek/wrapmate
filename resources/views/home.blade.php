@extends('layouts.app')

@section('content')

<div class="section background-grey">
    <div class="give-me-space" id="jak-to-dziala">
        <p class="before-header">Jak to działa?</p>
        <h2 class="header">Stwórz swój niepowtarzalny projekt.</h2>
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 text-center s-mb-3" data-aos="fade-in">
                        <div class="m-4">
                            <img alt="{{$post->image}}" v-lazy="'{{url('/storage/'.$post->image)}}'" class="w-25 m-auto">
                        </div>
                        <h3 class="my-2 font-weight-bold" style="text-transform: uppercase; font-size: 1.3rem">{{$post->title}}</h3>
                        <p class="lighten mt-4" style="text-align: justify">{!! strip_tags($post->content) !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@if(isset($second_post) && $second_post)
    <div class="section" style="overflow: hidden;">
        <div class="d-flex align-items-center" style="background-image: url('{{url('/storage/'.$second_post->image)}}'); background-position: center; background-repeat: no-repeat; background-size:cover; height: 650px; ">
            <div class="w-100">
                <div class="container">
                    <h3 class="text-white header text-left">{{$second_post->title}}</h3>
                    <p class="text-white" style="font-weight: 600; font-size: 1.1rem; letter-spacing: 1px; line-height: 1.6rem">{!! strip_tags($second_post->content) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endif
    <div class="section background-grey" style="overflow: hidden">
        <div class="give-me-space">
            <p class="before-header">Chcesz zacząć projektować ale nie wiesz do jakiego kształtu?</p>
            <h2 class="header">Uzyskaj darmowe pliki bazowe</h2>
            <div class="container">
                <div class="give-me-space">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bold">Pamiętaj aby: </h3>
                            <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget auctor ante. Nullam rhoncus mi neque, et commodo libero tristique vitae. Proin at consequat augue, eget venenatis arcu. Integer rhoncus ipsum ipsum, mattis feugiat velit posuere at.</p>
                            <md-button href="/pliki" class="my-button ml-0" :md-ripple="false">Uzyskaj pliki</md-button>
                        </div>
                        <div class="col-md-6">
                            <img class="home-car" src="{{url('/storage/default/bmw.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

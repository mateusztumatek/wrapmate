@extends('layouts.app')
@section('content')

    @if($page->display_gallery)
        <div class="container">
            @include('page.gallery')
        </div>
        @endif
    <div class="give-me-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12 @if(strlen(strip_tags($page->content)) > 1100) description-content @endif">
                    {!! $page->content !!}
                </div>
                @if(strlen(strip_tags($page->content)) > 1100)
                <div class="col-md-12 text-center mt-3 content-toggler">
                    <md-button :md-ripple="false" class="my-button" onclick="showDescription()">Zobacz więcej</md-button>
                </div>
                    @endif
            </div>
        </div>
    </div>
    @endsection

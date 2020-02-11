@extends('layouts.app')
@section('page_title')
    Zaprojektuj swój wzór samochodu online.
    @endsection

@section('page_description')
    Sprawdź nasz kreator online nadruków na karoserii. Wycena automatyczna.
    @endsection
@section('content')
    <div class="give-me-space">
        <div class="container my-container">

            <h1 class="header">Witaj w kreatorze.</h1>
            <model-picker></model-picker>
            <div class="row">
                <div class="col-md-12">
                    <creator-component v-cloak></creator-component>
                </div>
            </div>
        </div>
    </div>
    @endsection

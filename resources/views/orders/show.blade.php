@extends('layouts.app')
@section('banner')
    @endsection
@section('page_title')
    Zamówienie nr: {{$order->id}}
    @endsection
@section('page_description')
    Sprawdź dane, status oraz płatność zamówienia {{$order->id}}
    @endsection
@section('content')
    <div class="mt-5">
        <div class="give-me-space">
            <div class="container my-container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Zamówienie nr: {{$order->id}}</h1>
                        <p>Status zamówienia: <span class="font-weight-bold">{{$order->getStatusSlug()}}</span></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p>Status płatności: <span class="font-weight-bold">@if($order->paid) Zapłacone @else Nie zapłacone @endif</span></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p>Cena zamówienia: {{$order->amount}}zł</p>
                        Zamówienie do wykonania na modelu: <span class="font-weight-bold">{{$order->project['model']['name']}}</span>
                    </div>
                    <div class="col-md-5">
                        <img class="w-100" style="max-height: 600px; object-fit: contain" src="{{url('/storage/'.$order->project['model']['image_pattern'])}}">
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            @foreach($order->project['files'] as $file)
                                <div class="col-md-4" v-cloak>
                                    <md-card class="my-card">
                                        <md-card-header>
                                            <span>Projekt na elemencie {{$file['sign']['sign']}}</span>
                                            <p>Cena: {{$file['sign']['price']}}</p>
                                        </md-card-header>
                                        <md-card-content>
                                            <md-button href="{{url('/storage/'.$file['file'])}}" download class="md-raised md-primary">Pobierz projekt</md-button>
                                        </md-card-content>
                                    </md-card>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection

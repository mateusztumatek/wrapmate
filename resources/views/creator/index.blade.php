@extends('layouts.app')
@section('content')
    <div class="give-me-space">
        <div class="container my-container">

            <h1 class="header">Witaj w kreatorze.</h1>
            <div class="row">
                <div class="col-md-12">
                    <creator-component v-cloak></creator-component>
                </div>
            </div>
        </div>
    </div>
    @endsection

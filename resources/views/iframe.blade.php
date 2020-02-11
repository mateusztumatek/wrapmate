@extends('layouts.app')
@section('content')
    @if(isset($page) && $page)
    <div class="give-me-space">
        <div class="container my-container">
            <div class="row">
                <div class="col-md-12 @if(strlen(strip_tags($page->content)) > 1100) description-content @endif">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="section">
        <iframe src="https://www.ccvision.de/car-signer/index.php?lang=en&customer=107418&version=0" border="0" class="i-frame"></iframe>
    </div>
@endsection

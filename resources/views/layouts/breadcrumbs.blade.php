@php
    $breadcrumbs = \App\Services\Breadcrumbs::getBreadcrumbs();
@endphp
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item"><a href="{{$breadcrumb['link']}}">{{$breadcrumb['name']}}</a></li>
            @endforeach
        </ol>
    </nav>
</div>

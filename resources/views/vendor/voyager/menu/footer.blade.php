@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

@foreach($items as $main_item)
<div class="col-md-4">
    <ul>
        <li class="font-weight-bold">{{$main_item->title}}</li>
        @foreach($main_item->children as $item)
        <li><a href="{{$item->url}}">{{$item->title}}</a></li>
            @endforeach
    </ul>
</div>
    @endforeach

<div class="row justify-content-center">
    @foreach($items as $item)
        <div class="col-md-2 s-mb-1">
            <md-button class="md-raised my-button m-0 w-100 footer-link" href="{{ url($item->link()) }}" target="{{ $item->target }}">{{$item->title}}</md-button>
        </div>
    @endforeach
</div>

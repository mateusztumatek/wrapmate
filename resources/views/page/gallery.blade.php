@php
    if(request()->has('page')){
        $cache_name = 'gallery.'.request()->page;
    }else{
        $cache_name = 'gallery';
    }
    \Illuminate\Support\Facades\Cache::forget($cache_name);
    $galleries = \Illuminate\Support\Facades\Cache::get($cache_name);
    if(!$galleries){
        $galleries = \App\Gallery::paginate(10);
        \Illuminate\Support\Facades\Cache::put($cache_name, $galleries);
    }
@endphp
<transition name="fade">
    <div class="gallery" v-if="selectedGallery == null">
        @foreach($galleries as $gallery)
            <div style="position: relative" class="item">
                <img style="max-height: 600px; object-fit: contain" src="{{url('/storage/'.$gallery->image)}}">
                <div class="w-100 h-100 d-flex justify-content-center align-items-center content position-absolute" style="left: 0px; top: 0px; opacity: 0">
                    <md-button @click="selectedGallery = {{$gallery}}" class="md-raised md-primary">Zobacz więcej</md-button>
                </div>
            </div>
        @endforeach
    </div>
</transition>
<transition-group name="fade">
    @foreach($galleries as $gallery)
        <div key="{{$gallery->id}}" class="row" v-show="selectedGallery && selectedGallery.id == '{{$gallery->id}}'">
            <div class="col-md-6">
                <img src="{{url('/storage/'.$gallery->image)}}" class="w-100">
            </div>
            <div class="col-md-6">
                <h2>{{$gallery->title}}</h2>
                <p class="my-5">
                    {{$gallery->description}}
                </p>
                <md-button @click="selectedGallery = null" class="my-button">Powróć do galerii</md-button>
                @if($gallery->url)
                <md-button href="{{$gallery->url}}" class="my-button">Zobacz stronę</md-button>
                    @endif
            </div>
        </div>
    @endforeach
</transition-group>
<div v-show="selectedGallery == null" class="d-flex justify-content-center my-3">
    {{$galleries->links()}}
</div>


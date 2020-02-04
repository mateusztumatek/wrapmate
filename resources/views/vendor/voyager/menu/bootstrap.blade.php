@if(!isset($innerLoop))
    <ul class="navbar-nav ml-auto">
        @else
            <ul class="dropdown-menu">
                @endif

                @php

                    if (Voyager::translatable($items)) {
                        $items = $items->load('translations');
                    }

                @endphp

                @foreach ($items as $item)
                    @php
                        try{
                            $l = url($item->link());
                        }catch(Exception $e){
                            $l = '#';
                        }
                    @endphp
                    @php

                        $originalItem = $item;
                        if (Voyager::translatable($item)) {
                            $item = $item->translate($options->locale);
                        }

                        $listItemClass = null;
                        $linkAttributes =  null;
                        $styles = null;
                        $icon = null;
                        $caret = null;

                        // Background Color or Color
                        if (isset($options->color) && $options->color == true) {
                            $styles = 'color:'.$item->color;
                        }
                        if (isset($options->background) && $options->background == true) {
                            $styles = 'background-color:'.$item->color;
                        }

                        // With Children Attributes
                        if(!$originalItem->children->isEmpty()) {
                            $linkAttributes =  'class="dropdown-toggle" data-toggle="dropdown"';
                            $caret = '<span class="caret"></span>';

                            if($l == url()->current()){
                                $listItemClass = 'dropdown active';
                            }else{
                                $listItemClass = 'dropdown';
                            }
                        }

                        // Set Icon
                        if(isset($options->icon) && $options->icon == true){
                            $icon = '<i class="' . $item->icon_class . '"></i>';
                        }
                    @endphp

                    <li class="{{ $listItemClass }} nav-item">

                        <a href="{{ $l }}" class="nav-link @if($item->parameters && property_exists($item->parameters, 'slug') && request()->is('strona/'.$item->parameters->slug)) active @endif" target="{{ $item->target }}" style="{{ $styles }}" {!! $linkAttributes ?? '' !!}>
                            {!! $icon !!}
                            <span class="black-color">{{ $item->title }}</span>
                            {!! $caret !!}
                        </a>
                        @if($item->children)
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($item->children as $item)
                                @php
                                    try{
                                        $ch_l = url($item->link());
                                    }catch (Exception $exception){
                                        $ch_l = '#';
                                    }
                                @endphp
                                <a class="dropdown-item" href="{{$ch_l}}">{{$item->title}}</a>
                            @endforeach
                        </div>
                        @endif
                        {{--@if(!$originalItem->children->isEmpty())
                            @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                        @endif--}}
                    </li>
                @endforeach

            </ul>

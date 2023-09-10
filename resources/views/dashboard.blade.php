
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/main.js', 'resources/css/main.css'])
    <title>Let's Study</title>
</head>
<body>
    @include('header') 

    <div class="container-xxl main-wrap">
        <div class="row">
            <div class="topic-nav-wrap col-12 col-sm-4 col-md-4">
                <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider="center: true; finite: true;">
                    <ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-2@m uk-grid">
                        @foreach ($eventTypes as $eventType)
                        <li class="uk-width-1-4 uk-width-1-2@s"
                        @if (!is_null($eventType->type_name)) 
                            data-topic-filter="[data-topic-tag='{{ $eventType->type_name }}']"
                        @endif
                        >
                            <a href="" class="{{ is_null($eventType->type_name) ? 'tag-active' : 'tag' }}">
                                <div class="uk-panel">
                                    <div class="topic-tag" >
                                        <div class="uk-position-center uk-panel"><h1>{{ $eventType->name }}</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover slidenav-icon" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover slidenav-icon" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </div>
            <div class="main-card col-12 col-sm-8 col-md-8">
                <ul class="">
                    @foreach ($events as $event)
                    <li data-topic-tag="{{ $event->type_name }}">
                        <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                        <div class="card-content">
                            <a href="/event/view/{{ $event->id }}">
                                <div class="title">{{ $event->title }}</div>
                                <div class="intro-content">{{ $event->introduction }}</div>
                                <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i> {{ $event->start_date }} ~ {{ $event->end_date }} </div>
                                <div class="location-content"><i class="fa-solid fa-location-dot"></i> {{ $event->location }} </div>                                
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>            
        </div>

    </div>

    @include('footer')

    @include('popupModal')
</body>
<script>
    @if (isset($showMessage) && $showMessage === 'store_successful')
        alert('請至註冊的信箱收信，預計5-10分鐘內會收到');
    @endif
</script>
</html>
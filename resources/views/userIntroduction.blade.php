<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/main.js'])

    <title>Let's Study</title>
</head>
<body>
    @include('header')

    <div class="container-xxl main-wrap">
        <div class="">
            <div class="row myAm-box">
                <div class="nav nav-pill col-md-3 memberInfo-wrap" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="member-avatar">
                        <div class="member-photo">
                            <img src="/img/default-avatar.png" alt="">
                        </div>
                        <div class="member-name">{{ $user->nickname }}</div>
                    </div>
                    <div class="memberInfo-txt"><!--
                        是個愛漂流四方的人 <br>
                        是個讀千萬卷書的人-->
                    </div>
                    <div class="am-nav">
                        <button class="nav-link active" id="v-pills-join-tab" data-bs-toggle="pill" data-bs-target="#v-pills-join" type="button" role="tab" aria-controls="v-pills-join" aria-selected="true"><i class="fa-solid fa-caret-right"></i>我參加的活動</button>
                        <button class="nav-link" id="v-pills-initiate-tab" data-bs-toggle="pill" data-bs-target="#v-pills-initiate" type="button" role="tab" aria-controls="v-pills-initiate" aria-selected="false"><i class="fa-solid fa-caret-right"></i>我發起的活動</button>
                    </div>
                </div>
                <div class="tab-content am-container col-md-9" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-join" role="tabpanel" aria-labelledby="v-pills-join-tab" tabindex="0">
                        <ul class="nav mb-3 nav-underline" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="join-notStart-tab" data-bs-toggle="pill" data-bs-target="#join-notStart" type="button" role="tab" aria-controls="join-notStart" aria-selected="true">未開始</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="join-started-tab" data-bs-toggle="pill" data-bs-target="#join-started" type="button" role="tab" aria-controls="join-started" aria-selected="false">已開始</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="join-over-tab" data-bs-toggle="pill" data-bs-target="#join-over" type="button" role="tab" aria-controls="join-over" aria-selected="false">已結束</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="join-notStart" role="tabpanel" aria-labelledby="join-notStart-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($joinedEvents as $event)
                                            @if ($event->start_date > date('Y/m/d') && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>    
                            </div>
                            <div class="tab-pane fade" id="join-started" role="tabpanel" aria-labelledby="join-started-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($joinedEvents as $event)
                                            @if ($event->start_date <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $event->end_date && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="join-over" role="tabpanel" aria-labelledby="join-over-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($joinedEvents as $event)
                                            @if ($event->end_date < date('Y-m-d H:i:s') && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-initiate" role="tabpanel" aria-labelledby="v-pills-initiate-tab" tabindex="0">
                        <ul class="nav mb-3 nav-underline" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="initiate-notStart-tab" data-bs-toggle="pill" data-bs-target="#initiate-notStart" type="button" role="tab" aria-controls="initiate-notStart" aria-selected="true">未開始</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="initiate-started-tab" data-bs-toggle="pill" data-bs-target="#initiate-started" type="button" role="tab" aria-controls="initiate-started" aria-selected="false">已開始</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="initiate-over-tab" data-bs-toggle="pill" data-bs-target="#initiate-over" type="button" role="tab" aria-controls="initiate-over" aria-selected="false">已結束</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="initiate-notStart" role="tabpanel" aria-labelledby="initiate-notStart-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($postedEvents as $event)
                                            @if ($event->start_date > date('Y-m-d H:i:s') && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>   
                            </div>
                            <div class="tab-pane fade" id="initiate-started" role="tabpanel" aria-labelledby="initiate-started-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($postedEvents as $event)
                                            @if ($event->start_date <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $event->end_date && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="initiate-over" role="tabpanel" aria-labelledby="initiate-over-tab" tabindex="0">
                                <div class="main-card">
                                    <ul class="">
                                        @foreach ($postedEvents as $event)
                                            @if ($event->end_date < date('Y-m-d H:i:s') && $event->is_post == 1)
                                        <li data-topic-tag="{{ $event->type_name }}">
                                            <div class="topic-tag-icon tag-{{ $event->type_name }}">{{ $event->name }}</div>
                                            <div class="card-content">
                                                <a href="/event/view/{{ $event->id }}">
                                                    <div class="title">{{ $event->title }}</div>
                                                    <div class="intro-content">{{ $event->introduction }}</div>
                                                    <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i>{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                    <div class="location-content"><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</div>                                
                                                </a>
                                            </div>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>

    @include('footer')

    @include('popupModal')
</body>
</html>

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
        <div class="activity-detail-wrap">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="ad-main-img rounded " style="background-image: url('/{{ $viewPageData->event->image_path }}');"></div>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="topic-tag tag-book">{{ $viewPageData->event->name }}</div>
                    <h1 class="title">{{ $viewPageData->event->title }}</h1>
                    <div class="ad-info mb-3">
                        主辦人：<a href="/user/introduction/{{ $viewPageData->event->created_by }}" target="_blank">{{ $viewPageData->event->organizer }}</a>
                        <button class="btn btn-sm mailInfo-btn" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="mmmm@gmail.com"><i class="fa-regular fa-envelope"></i></button>
                    </div>
                    <div class="ad-info">{{ $viewPageData->event->introduction }}</div>
                    <div class="deadline-box">
                        <div class="ad-sub-title">報名截止時間</div><span class="ad-sub-info deadline">{{ $viewPageData->event->registration_date }}</span>
                    </div>
                    <div class="ad-info">尚有 <span class="notice-tip">{{ $viewPageData->event->participants_amount - count($viewPageData->participants) }}</span> 個報名空位。</div>
                    <div class="join-btn"><a href="/event/join/{{ $viewPageData->event->id }}/{{ $viewPageData->user->id ?? 0 }}" class="btn btn-default {{ ($viewPageData->event->participants_amount - count($viewPageData->participants)) === 0 ? 'disabled' : '' }}">我要加入</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="ad-box">
                        <div class="ad-title">活動資訊</div>
                        <div class="ad-info">
                            <div class="ad-box-info">
                                <div class="ad-sub-title">活動時間</div><span class="ad-sub-info">{{ $viewPageData->event->start_date }} {{ (is_null($viewPageData->event->end_date)) ? '' : ' ~ ' . $viewPageData->event->end_date }}</span>
                            </div>
                            <div class="ad-box-info">
                                <div class="ad-sub-title">活動地點</div><span class="ad-sub-info">{{ $viewPageData->event->location }}</span>
                            </div>
                            <!-- <div class="ad-box-info">
                                <div class="ad-sub-title">參與對象</div><span class="ad-sub-info">{{ $viewPageData->event->introduction }}</span>
                            </div> -->
                        </div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">活動目標計畫</div>
                        <div class="ad-info">{{ $viewPageData->event->plan }}</div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">活動詳細內容</div>
                        <div class="ad-info">{!! $viewPageData->event->detail !!}</div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">注意事項</div>
                        <div class="ad-info">{{ $viewPageData->event->note }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="ad-box">
                        <div class="ad-title">參加者</div>
                        <ul class="join-member-list">
                            @foreach ($viewPageData->participants as $participant)
                            <li class="join-member">
                                <a href="{{ $participant->participant_id === 0 ? '#' : '/user/introduction/' . $participant->participant_id }}">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">{{ $participant->participant }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>            
        </div>

    </div>
    
    @include('footer')

    @include('popupModal')
</body>
</html>
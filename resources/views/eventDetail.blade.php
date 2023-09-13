
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
                    <div class="ad-main-img rounded " style="background-image: url('/img/demo-img.jpg');"></div>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="topic-tag tag-book">{{ $event->name }}</div>
                    <h1 class="title">{{ $event->title }}</h1>
                    <div class="ad-info mb-3">
                        主辦人：<a href="members.html" target="_blank">Yi Yin</a>
                        <button class="btn btn-sm mailInfo-btn" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="mmmm@gmail.com"><i class="fa-regular fa-envelope"></i></button>
                    </div>
                    <div class="ad-info">{{ $event->description }}</div>
                    <div class="deadline-box">
                        <div class="ad-sub-title">報名截止時間</div><span class="ad-sub-info deadline">{{ $event->registration_date }}</span>
                    </div>
                    <div class="ad-info">尚有 <span class="notice-tip">{{ $event->participants_amount - count(json_decode($event->participants)) }}</span> 個報名空位。</div>
                    <div class="join-btn"><a href="/event/join/{{ $event->id }}" class="btn btn-default">我要加入</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="ad-box">
                        <div class="ad-title">活動資訊</div>
                        <div class="ad-info">
                            <div class="ad-box-info">
                                <div class="ad-sub-title">活動時間</div><span class="ad-sub-info">{{ $event->start_date }} ~ {{ $event->end_date }}</span>
                            </div>
                            <div class="ad-box-info">
                                <div class="ad-sub-title">活動地點</div><span class="ad-sub-info">{{ $event->location }}</span>
                            </div>
                            <div class="ad-box-info">
                                <div class="ad-sub-title">參與對象</div><span class="ad-sub-info">歡迎喜愛閱讀相關類型書籍的伙伴加入我們:)</span>
                            </div>
                        </div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">活動目標計畫</div>
                        <div class="ad-info">{{ $event->plan }}</div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">活動詳細內容</div>
                        <div class="ad-info">{{ $event->detail }}</div>
                    </div>
                    <div class="ad-box">
                        <div class="ad-title">注意事項</div>
                        <div class="ad-info">{{ $event->note }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="ad-box">
                        <div class="ad-title">參加者</div>
                        <ul class="join-member-list">
                            <li class="join-member">
                                <a href="members.html">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">Yi Yin</span>
                                </a>
                            </li>
                            <li class="join-member">
                                <a href="#">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">小猴</span>
                                </a>
                            </li>
                            <li class="join-member">
                                <a href="#">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">阿明</span>
                                </a>
                            </li>
                            <li class="join-member">
                                <a href="#">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">Elsa</span>
                                </a>
                            </li>
                            <li class="join-member">
                                <a href="#">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">Elsa</span>
                                </a>
                            </li>
                            <li class="join-member">
                                <a href="#">
                                    <img src="/img/default-user.png" alt="" class="img-fluid join-user-img">
                                    <span class="">Elsa</span>
                                </a>
                            </li>
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
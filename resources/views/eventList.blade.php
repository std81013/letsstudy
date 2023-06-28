
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/main.js', 'resources/css/main.css'])
    <title>Let's Study</title>
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-sm fixed-top main-nav">
                <div class="container-xxl">
                    <a class="navbar-brand" href="index.html">      
                        <img src="/img/logo.png" alt="" width="100" >
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="fa-solid fa-bars"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                        <button type="button" class="btn-close text-reset btn-close-custom" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                        </div>
                        <div class="offcanvas-body">
                            <form class="search-box">
                                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                                <button class="btn btn-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>  
                            <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-icon"><i class="fa-solid fa-user"></i></div> <span class="accountManagement-text">帳戶管理</span> 
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item" href="/event/add">活動發表</a></li>
                                        <li><a class="dropdown-item" href="/event/list">我的活動</a></li>
                                        <li><a class="dropdown-item" href="account.html">帳號資料</a></li>
                                        <li><a class="dropdown-item" href="#">登出</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>            
        </div>
    </header>
    <div class="container-xxl main-wrap">
        <div class="am-wrap pb-3">
            <div class="main-title">我的活動管理</div>
            <div class="row myAm-box">
                <div class="nav nav-pills am-nav col-md-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-join-tab" data-bs-toggle="pill" data-bs-target="#v-pills-join" type="button" role="tab" aria-controls="v-pills-join" aria-selected="true"><i class="fa-solid fa-caret-right"></i>我參加的活動</button>
                    <button class="nav-link" id="v-pills-initiate-tab" data-bs-toggle="pill" data-bs-target="#v-pills-initiate" type="button" role="tab" aria-controls="v-pills-initiate" aria-selected="false"><i class="fa-solid fa-caret-right"></i>我發起的活動</button>
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
                                <ul class="am-list">
                                    @foreach ($joinedEvents as $event)
                                        @if ($event->start_date > date('Y/m/d') && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="join-started" role="tabpanel" aria-labelledby="join-started-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($joinedEvents as $event)
                                        @if ($event->start_date <= date('Y/m/d') && date('Y/m/d') <= $event->end_date && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="join-over" role="tabpanel" aria-labelledby="join-over-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($joinedEvents as $event)
                                        @if ($event->end_date < date('Y/m/d') && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
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
                                <button class="nav-link" id="initiate-notPost-tab" data-bs-toggle="pill" data-bs-target="#initiate-notPost" type="button" role="tab" aria-controls="initiate-notPost" aria-selected="false">草稿夾</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="initiate-over-tab" data-bs-toggle="pill" data-bs-target="#initiate-over" type="button" role="tab" aria-controls="initiate-over" aria-selected="false">已結束</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="initiate-notStart" role="tabpanel" aria-labelledby="initiate-notStart-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($postedEvents as $event)
                                        @if ($event->start_date > date('Y/m/d') && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="initiate-started" role="tabpanel" aria-labelledby="initiate-started-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($postedEvents as $event)
                                        @if ($event->start_date <= date('Y/m/d') && date('Y/m/d') <= $event->end_date && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-address-book"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="initiate-notPost" role="tabpanel" aria-labelledby="initiate-notPost-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($postedEvents as $event)
                                        @if ($event->is_post == 0)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="initiate-over" role="tabpanel" aria-labelledby="initiate-over-tab" tabindex="0">
                                <ul class="am-list">
                                    @foreach ($postedEvents as $event)
                                        @if ($event->end_date < date('Y/m/d') && $event->is_post == 1)
                                    <li class="am-item">
                                        <div class="am-content">
                                            <div class="am-title">
                                                <span class="me-auto">{{ $event->title }}</span>
                                                <button class="btn btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                <button class="btn btn-sm"><i class="fa-solid fa-address-book"></i></button>
                                            </div>
                                            <div class="am-info">
                                                <div>
                                                    <label for="">活動時間</label>
                                                    <div class="date-info">{{ $event->start_date }} ~ {{ $event->end_date }}</div>
                                                </div>
                                                <div>
                                                    <label for="">報名人數</label>
                                                    <div class="peopleNumber-info">
                                                        <span class="joined-number">{{ count(json_decode($event->participants)) }}</span>/{{ $event->participants_amount }}
                                                    </div>
                                                </div>
                                            </div>
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
    <footer>
        <div class="container-xxl">
            <div class="row footer-wrap">
                <div class="col-6 col-sm-3 mb-3">
                    <ul>
                        <li><div class="title">關於</div></li>
                        <li><a href="about.html">關於我們</a></li>
                        <li><a href="service.html">服務條款</a></li>
                        <li><a href="privacy.html">隱私權政策</a></li>
                    </ul>
                </div>
                <div class="col-6 col-sm-3 mb-3">
                    <ul>
                        <li><div class="title">幫助</div></li>
                        <li><a href="useinfo.html">使用說明</a></li>
                        <li><a href="qna.html">常見問題</a></li>
                    </ul>
                </div>
                <div class="col-6 col-sm-3 mb-3">
                    <ul class="social-link">
                        <li><div class="title">社群</div></li>
                        <li><a href="">Facebook</a></li>
                        <li><a href="">Instagram</a></li>
                    </ul>
                </div>
                <div class="col-6 col-sm-3 mb-3 logo-footer">
                    <div class="">
                        <img src="/img/dark-logo.png" alt="" width="100">
                    </div>
                </div>
            </div>            
        </div>
    </footer>
</body>
</html>

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
                    <a class="navbar-brand" href="/">      
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
                                        <li><a class="dropdown-item" href="post-article.html">活動發表</a></li>
                                        <li><a class="dropdown-item" href="my-activities.html">我的活動</a></li>
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
        <div class="activity-detail-wrap">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="ad-main-img rounded " style="background-image: url('/img/demo-img.jpg');"></div>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="topic-tag tag-book">{{ $event->type }}</div>
                    <h1 class="title">{{ $event->title }}</h1>
                    <div class="ad-info mb-3">
                        主辦人：<a href="members.html" target="_blank">Yi Yin</a>
                        <button class="btn btn-sm mailInfo-btn" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="mmmm@gmail.com"><i class="fa-regular fa-envelope"></i></button>
                    </div>
                    <div class="ad-info">{{ $event->description }}</div>
                    <div class="deadline-box">
                        <div class="ad-sub-title">報名截止時間</div><span class="ad-sub-info deadline">{{ $event->registration_date }}</span>
                    </div>
                    <div class="ad-info">尚有 <span class="notice-tip">7</span> 個報名空位。</div>
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
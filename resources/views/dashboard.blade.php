
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (isset($auth) && $auth)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-icon"><i class="fa-solid fa-user"></i></div> <span class="accountManagement-text">帳戶管理</span> 
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item" href="post-article.html">活動發表</a></li>
                                        <li><a class="dropdown-item" href="my-activities.html">我的活動</a></li>
                                        <li><a class="dropdown-item" href="account.html">帳號資料</a></li>
                                        <li><a class="dropdown-item" href="/logout">登出</a></li>
                                    </ul>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-right-to-bracket"></i> 登入</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-light btn-sm btn-signUp" href="/register"><i class="fa-solid fa-registered"></i> 註冊</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>            
        </div>
    </header>
    <div class="container-xxl main-wrap">
        <div class="row">
            <div class="topic-nav-wrap col-12 col-sm-4 col-md-4">
                <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider="center: true; finite: true;">
                    <ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-2@m uk-grid">
                        <li class="uk-width-1-4 uk-width-1-2@s" data-topic-filter>
                            <a href="" class="tag-active">
                                <div class="uk-panel">
                                    <div class="topic-tag" >
                                        <div class="uk-position-center uk-panel"><h1>全部</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='skill']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>專業技術</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='sport']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>運動</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='art']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>藝文</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='language']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>語言</h1></div>
                                    </div>                            
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='entertainment']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>娛樂</h1></div>
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='book']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                    <div class="uk-position-center uk-panel"><h1>書籍</h1></div> 
                                    </div>
                                </div>                                
                            </a>
                        </li>
                        <li class="uk-width-1-4 uk-width-1-2@s"  data-topic-filter="[data-topic-tag='other']">
                            <a href="">
                                <div class="uk-panel">
                                    <div class="topic-tag">
                                        <div class="uk-position-center uk-panel"><h1>其他</h1></div>
                                    </div>                            
                                </div>                                
                            </a>
                        </li>
                    </ul>
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover slidenav-icon" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover slidenav-icon" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </div>
            <div class="main-card col-12 col-sm-8 col-md-8">
                <ul class="">
                    <li data-topic-tag="art">
                        <div class="topic-tag-icon tag-art">藝文</div>
                        <div class="card-content">
                            <a href="activity-detail.html">
                                <div class="title">伊勢英子繪本原畫展-<生命的形式>紀錄電影放映</div>
                                <div class="intro-content">灰灰基地美術館11月～2月展覽。 日本知名插畫家伊勢英子原畫展與紀錄電影 < 生...</div>
                                <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i> 2021-03-05(五) 10:00 ~ 2021-04-20(二) 18:00 </div>
                                <div class="location-content"><i class="fa-solid fa-location-dot"></i> 高雄市新興區民有街84,86號 ((近高雄捷運中央公園站))</div>                                
                            </a>
                        </div>
                    </li>
                    <li data-topic-tag="language">
                        <div class="topic-tag-icon tag-language">語言</div>
                        <div class="card-content">
                            <a href="">
                                <div class="title">英文口說讀書會</div>
                                <div class="intro-content">全程英文，無需刻意準備，不拘束，輕鬆進行。第一小時閒聊；第二小時採主題進行...</div>
                                <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i> 2021-03-05(五)  ~ 2021-04-20(二) </div>
                                <div class="location-content"><i class="fa-solid fa-location-dot"></i> 中壢區，光南附近的摩斯漢堡。</div>                                
                            </a>
                        </div>
                    </li>
                    <li data-topic-tag="book">
                        <div class="topic-tag-icon tag-book">書籍</div>
                        <div class="card-content">
                            <a href="/event/view/1">
                                <div class="title">《深度學習的技術》讀書會</div>
                                <div class="intro-content">我們讀書會已成立一年囉，運作良好，成員們也都很好相處，這是去年 2017 Reading…</div>
                                <div class="dateTime-content"><i class="fa-solid fa-calendar-days"></i> 2021/04/30(五) 19:30 </div>
                                <div class="location-content"><i class="fa-solid fa-location-dot"></i> 伯朗南京一店（台北市中山區南京東路二段218號，建國南京交叉路口）</div>                                
                            </a>
                        </div>
                    </li>
                </ul>
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

    <!-- Modal 登入視窗 -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">登入</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">請輸入您的 Email</label>
                            <input type="email" name="email" class="form-control" id="logInEmailInput" placeholder="" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="passwordInput" class="form-label">請輸入您的密碼</label>
                            <input type="password" name="password" class="form-control" id="passwordInput" autocomplete="current-password" placeholder="" required value="">
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-default">登入</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="" data-bs-target="#forgetPasswordModal" data-bs-toggle="modal">忘記密碼</a>
                        <div class="m-3">您還沒註冊嗎？<a href="/register">註冊</a></div> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 忘記密碼視窗 -->
    <div class="modal fade" id="forgetPasswordModal" tabindex="-1" aria-labelledby="forgetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgetPasswordModalLabel">忘記密碼</h5>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            請輸入註冊 Lest Study 的 Email 信箱，我們將寄送【 重設密碼驗證信 】！
                        </div>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">請輸入您的 Email</label>
                            <input type="email" class="form-control" id="forgetPwEmailInput" placeholder="name@example.com">
                        </div>
                        <div class="text-center mb-3"><!--ajax  並送user田的帳號-->
                            <button type="submit" class="btn btn-default">重設密碼</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="" data-bs-target="#loginModal" data-bs-toggle="modal">登入 Let's Study</a>
                        <div class="m-3">您還沒註冊嗎？<a href="/register">註冊</a></div>                        
                    </div>
                </div>
           
            </div>
        </div>
    </div>
</body>
<script>
    @if (isset($showMessage) && $showMessage === 'store_successful')
        alert('請至註冊的信箱收信，預計5-10分鐘內會收到');
    @endif

</script>
</html>
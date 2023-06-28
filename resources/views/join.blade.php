
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
        <div class="am-wrap pb-5">
            <div class="main-title">填寫報名資料</div>
            <form method="POST" action="/event/join" id="registrationForm">
                @csrf
                <div class="mb-4 row align-items-center fs-5">
                    <div class="col-auto">
                        <label for="adName" class="col-form-label">活動名稱：</label>
                    </div>
                    <div class="col-auto">
                        <span id="adName" class="">{{ $event->title }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="joinMemberInput" class="form-label">參加者姓名</label>
                        <input type="text" class="form-control" id="joinMemberInput" placeholder="" required>
                    </div>
                    <div class="col-md-4">
                        <label for="contactEmailInput" class="form-label">連絡 Email</label>
                        <input type="email" class="form-control" id="contactEmailInput" placeholder="xxx@gmail.cpm" required>
                    </div>
                    <div class="col-md-4">
                        <label for="contactNumberInput" class="form-label">聯絡電話</label>
                        <input type="text" class="form-control" id="contactNumberInput" placeholder="09xxxxxxxx" required>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <label for="memberRemarkTextarea" class="form-label">備註</label>
                    <textarea name="" id="memberRemarkTextarea" cols="30" rows="3" class="form-control" required>無</textarea>
                    <div id="" class="form-text">
                        請輸入要留言給主辦人的話，若沒有請輸入“無”。
                    </div>
                </div>
                <div class="my-4 text-center">
                    <div id="" class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="" id="joinCheck">
                        <label class="form-check-label" for="joinCheck">
                            我已仔細閱讀「<a href="service.html" target="_blank">服務條款</a> 」，並同意遵守相關規定。 
                        </label>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-default">確認報名</button>
                </div>
            </form>
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
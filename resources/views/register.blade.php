
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
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-right-to-bracket"></i> 登入</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-light btn-sm btn-signUp" href="signup.html"><i class="fa-solid fa-registered"></i> 註冊</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>            
        </div>
    </header>
    <div class="container-xxl main-wrap">
        <div class="sm-wrap pb-5">
            <div class="main-title">註冊</div>
            <form method="POST" action="/store" >
                @csrf
                <div class="mb-3">
                    <label for="signUpEmailInput" class="form-label">註冊信箱</label>
                    <input type="email" class="form-control" id="signUpEmailInput" name="email" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="signUpPwInput" class="form-label">密碼</label>
                    <input type="password" id="signUpPwInput" name="password" class="form-control" aria-labelledby="passwordHelpBlock" placeholder="" required>
                    <div id="passwordHelpBlock" class="form-text">
                        請輸入 8 - 16 個半型英數字元
                    </div>
                </div>
                <div class="mb-3">
                    <label for="signUpPwAgainInput" class="form-label">確認密碼</label>
                    <input type="password" id="signUpPwAgainInput" class="form-control" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="nickNameInput" class="form-label">暱稱</label>
                    <input type="text" class="form-control" id="nickNameInput" name="nickname" placeholder="" aria-labelledby="nickNameHelpBlock" required>
                    <div id="nickNameHelpBlock" class="form-text">
                        這是您在 Lets Study 的暱稱，將公開給其他朋友認識您。
                    </div>
                </div>
                <div class="my-4">
                    <div id="" class="form-text">
                        ※ 當您按下「註冊」鈕，即表示您同意網站 <a href="service.html" target="_blank">服務條款</a> 以及 <a href="privacy.html" target="_blank">隱私權政策</a>。
                    </div>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-default">註冊</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a href="" data-bs-target="#loginModal" data-bs-toggle="modal" class="mx-2">登入網站</a> 
                <a href="" data-bs-target="#forgetPasswordModal" data-bs-toggle="modal" class="mx-2">忘記密碼</a>     
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
                    <form action="">
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">請輸入您的 Email</label>
                            <input type="email" class="form-control" id="logInEmailInput" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="passwordInput" class="form-label">請輸入您的密碼</label>
                            <input type="password" class="form-control" id="passwordInput" placeholder="" required>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-default">登入</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="" data-bs-target="#forgetPasswordModal" data-bs-toggle="modal">忘記密碼</a>
                        <div class="m-3">您還沒註冊嗎？<a href="signup.html">註冊</a></div> 
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
                            <input type="email" class="form-control" id="forgetPwEmailInput" placeholder="name@example.com" required>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-default">重設密碼</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="" data-bs-target="#loginModal" data-bs-toggle="modal">登入 Let's Study</a>
                        <div class="m-3">您還沒註冊嗎？<a href="signup.html">註冊</a></div>                        
                    </div>
                </div>
           
            </div>
        </div>
    </div>
</body>
</html>
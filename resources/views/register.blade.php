
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
        <div class="sm-wrap pb-5">
            <div class="main-title">註冊</div>
            <form method="POST" action="/user/store" >
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

    @include('footer')

    @include('popupModal')
</body>
</html>
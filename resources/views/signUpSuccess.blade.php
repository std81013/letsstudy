
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
            @if ($isVerify)
            <div class="main-title">歡迎加入</div>
            <form action="index.html" >
                <div class="my-5 text-center text-dark-emphasis">
                    <span class="text-bg-color nick-name-text">{{ $nickname }}</span> 歡迎您加入 Let‘s Study，恭喜您的帳戶已成功開通。
                </div>
                <div class="text-center mb-3">
                    <a class="nav-link btn btn-light btn-sm btn-signUp" href="/">開始使用</a>
                    <button type="submit" class="btn btn-default">開始使用</button><!--帶dashboard url及帳號資訊-->
                </div>
            </form>
            @else
            <div class="main-title">註冊</div>
            <form action="" >
                <div class="my-5 text-center text-dark-emphasis">
                    歡迎您加入 Let‘s Study，請到您的信箱讀取驗證信，完成註冊。
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-default">重寄驗證信</button>
                </div>
            </form>
            @endif
        </div>
    </div>
    
    @include('footer')

    @include('popupModal')
</body>
</html>
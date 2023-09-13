
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/main.js'])
    <title>Let's Study</title>

    <script type="module">
        $(".btn").on("click", function () {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('#csrf-token').val(),
                    email: $('#email').val(),
                    password: $('#signUpPwAgainInput').val()
                },
                url: '/user/updatePassword',
                }).done(function( success ) {
                if ( success ) {
                    alert('重設密碼成功');
                    window.location = '/';
                } else {
                    alert('重設密碼失敗');
                }
            });
        });
    </script>
</head>
<body>
    @include('header') 

    <div class="container-xxl main-wrap">
        <div class="sm-wrap pb-5">
            <div class="main-title">重設您的密碼</div>
            <form action="/user/updatePassward" >
                <input type="hidden" id="email" name="email" value="{{ $email }}">
                <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                <div class="mb-3">
                    <label for="signUpPwInput" class="form-label">請輸入新密碼</label>
                    <input type="password" id="signUpPwInput" class="form-control" aria-labelledby="passwordHelpBlock" placeholder="" required>
                    <div id="passwordHelpBlock" class="form-text">
                        請輸入 8 - 16 個半型英數字元
                    </div>
                </div>
                <div class="mb-3">
                    <label for="signUpPwAgainInput" class="form-label">確認新密碼</label>
                    <input type="password" id="signUpPwAgainInput" class="form-control" placeholder="" required>
                </div>
                <div class="text-center my-5">
                    <button type="button" class="btn btn-default">重新設定密碼</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('footer')

    @include('popupModal')
</body>
</html>
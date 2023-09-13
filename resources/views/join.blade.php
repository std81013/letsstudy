
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
    
    @include('footer')

    @include('popupModal')
</body>
</html>
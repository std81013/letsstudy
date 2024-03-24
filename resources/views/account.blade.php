
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js'])
    <title>Let's Study</title>
</head>
<body>
    @include('header')

    <div class="container-xxl main-wrap">
        <div class="am-wrap pb-3">
            <div class="main-title">帳號設定</div>
            <div class="row myAm-box">
                <div class="nav nav-pills am-nav col-md-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="true"><i class="fa-solid fa-caret-right"></i>我的帳號資料</button>
                    <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false"><i class="fa-solid fa-caret-right"></i>修改密碼</button>
                </div>
                <div class="tab-content am-container col-md-9" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab" tabindex="0">
                        <form action="/account/update" method="POST" id="accountForm" class="account-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <label for="signUpEmailInput" class="form-label">帳號</label>
                                        <input type="email" class="form-control" id="signUpEmailInput" placeholder="" readonly disabled value="{{ $user->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nickNameInput" class="form-label">暱稱</label>
                                        <input type="text" class="form-control" name="nickNameInput" id="nickNameInput" placeholder="" aria-labelledby="nickNameHelpBlock" required value="{{ $user->nickname }}">
                                        <div id="nickNameHelpBlock" class="form-text">
                                            這是您在 Lets Study 的暱稱，將公開給其他朋友認識您。
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-sm-4">
                                    <!-- <div class="mb-3">
                                        <div class="uploadImg-wrap personal-img">
                                            <div class="uploadImg-text">
                                                <i class="fa-solid fa-camera"></i>
                                                <div>上傳個人照片</div>                             
                                            </div>
                                            
                                            <input type="file" 
                                                    class="filepond"
                                                    name="filepond" 
                                                    data-allow-reorder="true"
                                                    data-max-file-size="3MB">
                                        </div>
                                    </div>                                        -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="selfInfoTextarea1" class="form-label">自我介紹</label>
                                <textarea class="form-control" name="selfInfoTextarea1" id="selfInfoTextarea1" rows="2" aria-labelledby="selfInfoHelpBlock">{{ $user->introduction }}</textarea>
                                <div id="selfInfoHelpBlock" class="form-text">
                                    請簡單的介紹自己，將公開在個人頁面給其他朋友認識您。(可省略)
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumInput" class="form-label">電話</label>
                                <input type="text" class="form-control" name="phoneNumInput" id="phoneNumInput" placeholder="" aria-labelledby="phoneNumHelpBlock" required value="{{ $user->phone }}">
                                <div id="phoneNumHelpBlock" class="form-text">
                                    請輸入您的聯絡電話。
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="genderOption" class="form-label">性別</label>
                                <div class="gender-option">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genderOption" id="maleOption" value="1" @if($user->gender == 1) checked @endif>
                                        <label class="form-check-label" for="maleOption">男</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genderOption" id="femaleOption" value="0" @if($user->gender == 0) checked @endif>
                                        <label class="form-check-label" for="femaleOption">女</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birthdayInput" class="form-label">生日</label>
                                <input type="text" name="birthdayInput" id="birthdayInput" class="form-control anotherSelector" value="{{ $user->birthday }}">                                
                            </div>
                            <div class="mb-3">
                                <label for="birthdayInput" class="form-label">隱私權設定</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="showEmail" name="displayEmail" value="1" @if($user->settings->display_email == true) checked @endif>
                                        <label class="form-check-label" for="showEmail">顯示Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="showJoinedEvents" name="displayJoinedEvent" value="1" @if($user->settings->display_joined_event == true) checked @endif>
                                        <label class="form-check-label" for="showJoinedEvents">顯示參加的活動</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="showEvensFormMe" name="displayHostEvent" value="1" @if($user->settings->display_host_event == true) checked @endif>
                                        <label class="form-check-label" for="showEvensFormMe">顯示主揪的活動</label>
                                    </div>
                                </div>                              
                            </div>
                            <div class="text-center mb-3">
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-default">儲存修改</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab" tabindex="0">
                        <form action="POST" id="changePasswordForm">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">帳號</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="" readonly disabled value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="pwNowInput" class="form-label">目前密碼</label>
                                <input type="password" name="pwNowInput" id="pwNowInput" class="form-control" placeholder="" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    請輸入目前密碼
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pwInput" class="form-label">新密碼</label>
                                <input type="password" name="pwInput" id="pwInput" class="form-control" aria-labelledby="passwordHelpBlock" placeholder="" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    請輸入新密碼  (請輸入 8 - 16 個半型英數字元)
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pwAgainInput" class="form-label">確認密碼</label>
                                <input type="password" name="pwAgainInput" id="pwAgainInput" class="form-control" placeholder="" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    請再次確認您的新密碼
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-default">儲存修改</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
        </div>
    </div>
    <script>
    @if (isset($showUpdateSuccess) && $showUpdateSuccess)
        alert('修改成功');
    @endif
</script>
    @include('footer')

    @include('popupModal')
</body>
</html>
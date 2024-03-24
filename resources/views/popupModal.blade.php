
<!-- Modal 登入視窗 -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">登入</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form method="POST" id="loginForm" action="/login">
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
                <form id="forgetPasswordForm">
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
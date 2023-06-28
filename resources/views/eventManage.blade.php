
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/main.js', 'resources/css/main.css', 'resources/js/form-validate.js', 'resources/js/datepicker.js', 'resources/js/fileupload.js'])
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
        <div class="am-wrap pb-3">
            <div class="main-title">發表活動</div>
            <form action="" id="activityManageForm">
                <div class="mb-4 row">
                    <div class="col-sm-5">
                        <div class="uploadImg-wrap">
                            <div class="uploadImg-text">
                                <i class="fa-solid fa-camera"></i>
                                <div>上傳主要圖片</div>
                                <div class="notice-tip">圖片尺寸至少 590px * 394px</div>                                
                            </div>
                            <!-- <input class="form-control form-control-sm" id="formFileSm" type="file"> -->
                            <!--TODO: 上傳圖片預覽圖的效果 -->
                            <input type="file" 
                                    class="filepond"
                                    name="filepond" 
                                    data-allow-reorder="true"
                                    data-max-file-size="3MB">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="my-3">
                            <label for="amTitleInput" class="form-label">活動標題</label>
                            <input type="text" class="form-control" id="amTitleInput" required>
                            <div class="notice-tip">發佈後無法再修改標題</div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-sm-5">
                                <label for="amTypeSelect" class="form-label">活動分類</label>
                                <select class="form-select" id="amTypeSelect" required>
                                    <option value="1">專業技術</option>
                                    <option value="2">運動</option>
                                    <option value="3">藝文</option>
                                    <option value="4">語言</option>
                                    <option value="5">娛樂</option>
                                    <option value="6">書籍</option>
                                    <option value="7">其他</option>
                                  </select>
                            </div>
                            <div class="col-6 col-sm-7">
                                <label for="deadlineInput" class="form-label">報名截止日</label>
                                <input type="text" name="" id="deadlineInput" class="form-control anotherSelector" required>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3 row">
                    <div class="col-sm-2">
                        <label for="joinNumberInput" class="form-label">參加人數</label>
                        <input type="number" class="form-control" id="joinNumberInput" placeholder="" required>
                    </div>
                    <div class="col-sm-10">
                        <label for="amDateInput" class="form-label">活動時間</label>
                        <div>
                            <input type="text" name="" id="amDateInput" class="form-control anotherSelector" required>
                            <div id="" class="form-text">
                                說明：可設定單日的日期時間或是有範圍的日期時間
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-6">
                        <label for="amLocationInput" class="form-label">活動地點</label>
                        <input type="text" class="form-control" id="amLocationInput" placeholder="" required>
                        <div id="" class="form-text">說明：請輸入活動地點（xx星巴克..or Skype...）</div>
                    </div>
                    <div class="col-sm-6">
                        <label for="organiserEmailInput" class="form-label">主辦人 Email</label>
                        <input type="email" class="form-control" id="organiserEmailInput" placeholder="" required>
                    </div>
                </div>
                <!--TODO: 研究Textarea文字送出後，可以簡單自動斷行（或是加入簡易的文字編輯器） -->
                <div class="mb-3">
                    <label for="organizerInfoTextarea" class="form-label">主辦單位簡介</label>
                    <textarea name="" id="organizerInfoTextarea" cols="30" rows="3" class="form-control" required></textarea>
                    <div id="" class="form-text">說明：輸入30~50字簡短主辦單位描述，讓更多人知道您。</div>
                </div>
                <div class="mb-3">
                    <label for="amGoalPlanTextarea" class="form-label">活動目標計畫</label>
                    <textarea name="" id="amGoalPlanTextarea" cols="30" rows="5" class="form-control" required></textarea>
                    <div id="" class="form-text">說明：輸入30~50字簡短活動目標計畫描述，讓更多人知道活動目的。</div>
                </div>
                <div class="mb-3">
                    <label for="amDetailsTextarea" class="form-label">活動詳細內容</label>
                    <textarea name="" id="amDetailsTextarea" cols="30" rows="10" class="form-control" required></textarea>
                    <div id="" class="form-text">說明：輸入詳細的活動資訊，讓更多人清楚知道活動內容。</div>
                </div>
                <div class="mb-3">
                    <label for="amNoticeTextarea" class="form-label">注意事項</label>
                    <textarea name="" id="amNoticeTextarea" cols="30" rows="10" class="form-control" required>無</textarea>
                    <div id="" class="form-text">說明：可輸入需要大家遵守或注意的事項。</div>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-outline-secondary mx-2">預覽頁面</button>
                    <button type="submit" class="btn btn-default mx-2">儲存草稿</button>
                    <button type="submit" class="btn btn-default mx-2">發佈活動</button>
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
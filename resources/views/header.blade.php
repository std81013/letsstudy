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
                            @if (!is_null(session('token')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-icon"><i class="fa-solid fa-user"></i></div> <span class="accountManagement-text">帳戶管理</span> 
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="offcanvasNavbarDropdown">
                                    <li><a class="dropdown-item" href="/event/add">活動發表</a></li>
                                    <li><a class="dropdown-item" href="/event/list">我的活動</a></li>
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
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
</header>
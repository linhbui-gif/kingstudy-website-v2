<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img src="/images/logo_king.png" alt="Onetouch Logo" class="brand-icon">

            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <img src="/html/img/icons/hambuger.png" alt="">
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->



                <!--Notification dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="title-page-top">
                    <span class="title">@yield('title', isset($title) ? $title : '')</span>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End notifications dropdown-->

            </ul>
            <ul class="nav navbar-top-links pull-right top-right-header">
                <li>
                    <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Tìm kiếm thông tin..">
                            <span class="input-group-btn">
                                <button type="button"><i class="demo-pli-magnifi-glass"></i></button>
                            </span>
                        </div>
                    </div>
                </li>

                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li>
                    <a class="email-selector" href="#">
                        <img src="/html/img/icons/bell.png" alt="">
                        <span class="pull-right badge badge-danger">24</span>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End language selector-->

                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user">
                    <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown">
                        <?php
                        $user = auth()->user();
                        $avatar = $user['image_url'].$user['image_location'];
                        ?>
                        <span class="pull-left">
                            <img class="img-circle img-user media-object" onerror="this.src='/images/user.png';"
                                 src="{{ empty($avatar)?'/images/user.png':url($avatar) }}" alt="">
                        </span>
                        <div class="username hidden-xs">{{ Auth::user()->full_name }}</div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                        <!-- Dropdown heading  -->
                        <div class="pad-all bord-btm">
                            <p class="text-main mar-btm">Xin chào, {{ Auth::user()->full_name }}</p>
                        </div>

                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="{!! route('adminauth::user.profile') !!}">
                                    <i class="demo-pli-male icon-lg icon-fw"></i> Thông tin của bạn
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('adminauth::user.change-password') !!}">
                                    <i class="fa fa-key" style="font-size: 16px;padding-right: 4px;"></i> Thay đổi mật khẩu
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="demo-pli-gear icon-lg icon-fw"></i> Cài đặt
                                </a>
                            </li>
                        </ul>

                        <!-- Dropdown footer -->
                        <div class="pad-all text-right">
                            <a href="{!! route('logout') !!}" class="btn btn-primary btn-rounded" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="demo-pli-unlock"></i> Thoát
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>

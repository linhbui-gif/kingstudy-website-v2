@php
use App\Helpers\Auth;

$user = Auth::getUserInfo();
$permissions = Auth::get_permissions($user);
$ac = \App\Helpers\General::get_controller_action();
@endphp
<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <ul id="mainnav-menu" class="list-group">

                        @php
                            $hp = Auth::has_permission('admin::dashboard.index', $user, $permissions);
                            $active = $ac['controller'] == 'AdminController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="{{ route('admin::dashboard.index') }}">
                                    <i class="fa fa-home fa-sm" aria-hidden="true"></i>
                                    <span class="menu-title">DASHBOARD</span>
                                </a>
                            </li>
                        @endif


                        {{--  End Quản lý Banner --}}
                        @php
                            $hp = Auth::has_permission(['admin::news.index', 'admin::categoryNew.index',], $user, $permissions);
                            $active = $ac['controller'] == 'NewsController' || $ac['controller'] == 'CategoryNewController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="#">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                    <span class="menu-title">Quản lý tin tức</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    @if(Auth::has_permission('admin::news.index', $user, $permissions))
                                        @php
                                            $sub_active = $ac['controller'] == 'NewsController' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('admin::news.index') }}">Danh sách tin tức</a></li>
                                    @endif

                                    @php
                                        $hp = Auth::has_permission('admin::categoryNew.index', $user, $permissions);
                                    @endphp
                                    @if($hp)
                                        @php
                                            $sub_active = $ac['controller'] == 'CategoryNewController' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('admin::categoryNew.index') }}">Danh sách danh mục</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif


                        @php
                            $hp = Auth::has_permission(['adminauth::user.index', 'adminauth::role.index',], $user, $permissions);
                            $active = $ac['controller'] == 'UserController' || $ac['controller'] == 'RoleController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="#">
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span class="menu-title">Phân quyền</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    @if(Auth::has_permission('adminauth::user.index', $user, $permissions))
                                        @php
                                            $sub_active = $ac['controller'] == 'UserController' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('adminauth::user.index') }}">Người dùng CMS</a></li>
                                    @endif

                                    @php
                                        $hp = Auth::has_permission('adminauth::role.getShowAll', $user, $permissions);
                                    @endphp
                                    @if($hp)
                                        @php
                                            $sub_active = $ac['controller'] == 'RoleController' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('adminauth::role.getShowAll') }}">Phân quyền</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @php
                            $hp = Auth::has_permission('admin::banner.index', $user, $permissions);
                            $active = $ac['controller'] == 'BannerController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="{{ route('admin::banner.index') }}">
                                    <i class="fa fa-television" aria-hidden="true"></i>
                                    <span class="menu-title">Quản lý Banners</span>
                                </a>
                            </li>
                        @endif
{{--                        Quanr lý học viên--}}
                        @php
                            $hp = Auth::has_permission('adminauth::student.index', $user, $permissions);
                            $active = $ac['controller'] == 'StudentController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="{{ route('adminauth::student.index') }}">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <span class="menu-title">Quản lý Học viên</span>
                                </a>
                            </li>
                        @endif
                        {{-- Contact --}}
                        @php
                            $hp = Auth::has_permission('admin::contacts.index', $user, $permissions);
                            $active = $ac['controller'] == 'ContactsController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="{{ route('admin::contacts.index') }}">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                    <span class="menu-title">Liên hệ</span>
                                </a>
                            </li>
                        @endif
                        {{-- Khóa học --}}
                        @php
                            $hp = Auth::has_permission('admin::course.index', $user, $permissions);
                            $active = $ac['controller'] == 'CourseController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::course.index') }}">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span class="menu-title">Khóa học</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Bậc học --}}
                        @php
                            $hp = Auth::has_permission('admin::levelCourse.index', $user, $permissions);
                            $active = $ac['controller'] == 'LevelCourseController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::levelCourse.index') }}">
                                <i class="fa fa-level-up" aria-hidden="true"></i>
                                <span class="menu-title">Bậc học</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Ngành học --}}
                        @php
                            $hp = Auth::has_permission('admin::majors.index', $user, $permissions);
                            $active = $ac['controller'] == 'MajorsController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::majors.index') }}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span class="menu-title">Ngành học</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Trường học --}}
                        @php
                            $hp = Auth::has_permission('admin::school.index', $user, $permissions);
                            $active = $ac['controller'] == 'SchoolController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::school.index') }}">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="menu-title">Trường học</span>
                            </a>
                        </li>
                        {{-- thaành phố  --}}
                        @php
                            $hp = Auth::has_permission('admin::city.index', $user, $permissions);
                            $active = $ac['controller'] == 'CityController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::city.index') }}">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="menu-title">Thành phố</span>
                            </a>
                        </li>

                        @php
                            $hp = Auth::has_permission('admin::ranking.index', $user, $permissions);
                            $active = $ac['controller'] == 'RankingController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::ranking.index') }}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span class="menu-title">Ranking</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Country --}}
                        @php
                            // $hp = Auth::has_permission('admin::country.index', $user, $permissions);
                            $active = $ac['controller'] == 'CountryController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::country.index') }}">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="menu-title">Country</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Study Abroad --}}
                        @php
                            // $hp = Auth::has_permission('admin::country.index', $user, $permissions);
                            $active = $ac['controller'] == 'StudyAbroadController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::studyAbroad.index') }}">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="menu-title">Quốc gia du học</span>
                            </a>
                        </li>
                        {{--  --}}
                        {{-- Menu --}}
                        @php
                            // $hp = Auth::has_permission('admin::ranking.index', $user, $permissions);
                            $active = $ac['controller'] == 'MenusController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::menus.index') }}">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span class="menu-title">Menus</span>
                            </a>
                        </li>
                        @php

                            $active = $ac['controller'] == 'WidgetController' ? 'active' : '';
                        @endphp
                        <li class="{{$active}}">
                            <a href="{{ route('admin::widget.index') }}">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span class="menu-title">Widget</span>
                            </a>
                        </li>
                        {{--  --}}
                        @php
                            $hp = Auth::has_permission(['admin::landing-page-position.index'], $user, $permissions);
                        @endphp
                        @if($hp)
                            @php
                                $landing_page_id = $ac['parameters']['landing_page_id'] ?? 0;
                                $active = $ac['controller'] == 'LandingPagePositionController' && in_array($landing_page_id, [1, 2, 3, 4, 5, 6, 7]) ? 'active' : '';
                                @endphp
                            <li class="{{$active}}">
                                <a href="#" aria-expanded="{{$active?'true':'false'}}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    <span class="menu-title">Chuyên trang</span>
                                    <i class="arrow"></i>
                                </a>

                                <ul class="collapse" aria-expanded="{{$active?'true':'false'}}">
                                    @php
                                        $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 1 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index',['landing_page_id' => 1]) }}">
                                            Trang chủ
                                        </a>
                                    </li>
                                    @php
                                    $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 3 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index', ['landing_page_id' => 3]) }}">
                                            Trang giới thiệu
                                        </a>
                                    </li>
                                    @php
                                        $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 9 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index', ['landing_page_id' => 9]) }}">
                                            Trang tin tức
                                        </a>
                                    </li>
                                    @php
                                    $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 4 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index', ['landing_page_id' => 4]) }}">
                                            Trang liên hệ
                                        </a>
                                    </li>

                                    @php
                                        $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 7 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index',['landing_page_id' => 7]) }}">
                                            Hướng dẫn
                                        </a>
                                    </li>
                                    @php
                                        $sub_active = $ac['as'] == 'admin::landingPagePosition.index' && $landing_page_id == 8 ? 'active' : '';
                                    @endphp
                                    <li class="{{$sub_active}}">
                                        <a href="{{ route('admin::landingPagePosition.index',['landing_page_id' => 8]) }}">
                                            Điều khoản
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @php
                            $hp = Auth::has_permission(['admin::setting.meta-seo','admin::setting.index', 'admin::province.index'], $user, $permissions);
                            $active = $ac['controller'] == 'SettingController' || $ac['controller'] == 'ProvinceController' ? 'active' : '';
                        @endphp
                        @if($hp)
                            <li class="{{$active}}">
                                <a href="#">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                    <span class="menu-title">Cấu hình</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    @if(Auth::has_permission('admin::setting.meta-seo', $user, $permissions))
                                        @php
                                            $sub_active = $ac['as'] == 'admin::setting.meta-seo' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('admin::setting.meta-seo') }}">Meta Seo</a></li>
                                    @endif

                                    @php
                                        $hp = Auth::has_permission('admin::setting.index', $user, $permissions);
                                    @endphp
                                    @if($hp)
                                        @php
                                            $sub_active = $ac['as'] == 'admin::setting.index' ? 'active' : '';
                                        @endphp
                                        <li class="{{$sub_active}}"><a href="{{ route('admin::setting.index') }}">Cấu hình</a></li>
                                    @endif

                                        @php
                                            $hp = Auth::has_permission('admin::province.index', $user, $permissions);
                                            $active = $ac['controller'] == 'ProvinceController' ? 'active' : '';
                                        @endphp
                                        @if($hp)
                                            <li class="{{$active}}">
                                                <a href="{{ route('admin::province.index') }}">Tỉnh thành</a>
                                            </li>
                                        @endif
                                </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->
    </div>
</nav>

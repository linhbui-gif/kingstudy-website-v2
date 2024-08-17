<div class="ModalLogout Modal" id="ModalLogout">
    <div class="Modal-overlay"> </div>
    <form class="Modal-main" style="max-width: 62.8rem;" method="post" action="{{route('front.logout')}}">
        @csrf
        <div class="Modal-header">
            THông báo</div>
        <div class="Modal-body">
            <div class="style-content">
                <p class="text-center">Xác nhận đăng xuất tài khoản</p>
                <div class="ModalLogout-form-submit flex justify-between" style="column-gap: 2rem;">
                    <div class="ModalLogout-form-submit-item" style="flex: 1">
                        <div class="Button Modal-close secondary small" data-modal-id="">
                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Hủy bỏ</span>
                            </button>
                        </div>
                    </div>
                    <div class="ModalLogout-form-submit-item" style="flex: 1">
                        <div class="Button Modal-close small" data-modal-id="">
                            <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Đồng ý</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="ModalAuth Modal" id="ModalAuth">
    <div class="Modal-overlay"> </div>
    <div class="Modal-main" style="max-width: 107.4rem;">
        <div class="Modal-body">
            <div class="ModalAuth-wrapper flex">
                <div class="ModalAuth-wrapper-item">
                    <form class="ModalAuth-form flex flex-col" action="{{ route('front.login') }}">
                        <div class="ModalAuth-form-logo"> <img src="{{asset('frontend/assets/logo_king.jpg')}}" alt="king-study"></div>
                        <h3 class="ModalAuth-form-title">Đăng nhập</h3>
                        <div class="noty_error"></div>
                        <div class="Input small bordered">
                            <input name="email" id="email" class="Input-control" type="text" placeholder="Nhập email">
                        </div>
                        <div class="Input small bordered">
                            <input name="password" id="password" class="Input-control" type="password" placeholder="Mật khẩu">
                        </div>
{{--                        <a class="ModalAuth-form-forgot-password Button js-open-modal" href="javascript:void(0)" data-modal-id="#ModalReset">Quên mật khẩu</a>--}}
                        <div class="Button secondary middle bordered" data-modal-id="#">
                            <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Đăng nhập</span></button>
                        </div><div class="ModalAuth-form-no-account Button js-open-modal" data-modal-id="#ModalRegister">Chưa có tài khoản?<strong>Đăng ký</strong></div>
                        @csrf
                    </form>
                </div>
                <div class="ModalAuth-wrapper-item">
                    <div class="owl-carousel ModalAuth-carousel" id="ModalAuth-carousel">
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ModalContactInformation Modal" id="ModalContactInformation">
    <div class="Modal-overlay"> </div>
    <div class="Modal-main">
        <div class="Modal-header">
            Thông tin liên hệ
            <div class="Modal-close Modal-header-close"><img src="{{asset('frontend/assets/icons/icon-close.svg')}}" alt=""></div>
        </div>
        <div class="Modal-body">
            <form class="ModalContactInformation-form" action="{{route('create_contacts')}}" id="contact_frm" method="POST">
                <div class="ModalContactInformation-form-control flex flex-wrap">
                    <div class="ModalContactInformation-form-item">
                        <div class="Input small bordered">
                            <input class="Input-control" name="name" type="text" placeholder="Tên của bạn">
                        </div>
                    </div>
                    <div class="ModalContactInformation-form-item">
                        <div class="Select small bordered">
                            <select class="Select-control" name="national" >
                                <option value="">Quốc gia du học</option>
                                @php
                                    $countries  = \Modules\Admin\Entities\Country::select('id','name')->get()->toArray();
                                @endphp
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}">{{$country['name']}}</option>
                                @endforeach
                            </select>
                            <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="ModalContactInformation-form-item">
                        <div class="Input small bordered">
                            <input class="Input-control" type="text" placeholder="Số điện thoại" name="phone">
                        </div>
                    </div>
                    <div class="ModalContactInformation-form-item">
                        <div class="Select small bordered">
                            <select class="Select-control" name="level_course">
                                <option value="">Bậc học</option>
                                @php
                                    $levels  = \Modules\Admin\Entities\LevelCourse::select('id','name')->get()->toArray();
                                @endphp
                                @foreach($levels as $level)
                                    <option value="{{$level['id']}}">{{$level['name']}}</option>
                                @endforeach
                            </select>
                            <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="ModalContactInformation-form-item">
                        <div class="Input small bordered">
                            <input class="Input-control" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="ModalContactInformation-form-item">
                        <div class="Select small bordered">
                            <select class="Select-control" name="ielts">
                                <option value="">Ielts</option>
                                <option value="5.5">Dười 5.5</option>
                                <option value="6">Từ 5.5 đến 7.0</option>
                                <option value="7">Trên 7.0</option>
                            </select>
                            <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="ModalContactInformation-form-submit flex justify-center">
                    <div class="Button secondary small" data-modal-id="">
                        <button id="btn_contact_frm" class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Gửi thông tin</span>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="school_id" id="frm_contact_school">
                @csrf
            </form>
        </div>
    </div>
</div>
<div class="ModalAuth Modal" id="ModalRegister">
    <div class="Modal-overlay"> </div>
    <div class="Modal-main" style="max-width: 107.4rem;">
        <div class="Modal-body">
            <div class="ModalAuth-wrapper flex">
                <div class="ModalAuth-wrapper-item">
                    <form class="ModalAuth-form flex flex-col" action="{{ route('front.register') }}">
                        <div class="ModalAuth-form-logo"> <img src="{{asset('frontend/assets/logo_king.jpg')}}" alt="king-study"></div>
                        <h3 class="ModalAuth-form-title">Đăng ký</h3>
                        <div class="noty_error"></div>
                        <div class="Input small bordered">
                            <input name="register_email" id="register_email" class="Input-control" type="email" placeholder="Nhập email">
                            <label id="register_email-error" class="error" for="register_email" style="display: none"></label>
                        </div>
                        <div class="Input small bordered">
                            <input name="register_phone" id="register_phone" class="Input-control" type="text" placeholder="Nhập số điện thoại">
                            <label id="register_phone-error" class="error" for="register_phone" style="display: none"></label>
                        </div>
                        <div class="Input small bordered">
                            <input name="register_password" id="register_password" class="Input-control" type="password" placeholder="Mật khẩu">
                            <label id="register_password-error" class="error" for="register_password" style="display: none"></label>
                        </div>
                        <div class="Input small bordered">
                            <input name="password_confirmation" id="password_confirmation" class="Input-control" type="password" placeholder="Nhập lại mật khẩu">
                            <label id="password_confirmation-error" class="error" for="password_confirmation" style="display: none"></label>
                        </div>
{{--                        <a class="ModalAuth-form-forgot-password" href="#">Quên mật khẩu</a>--}}
                        <div class="Button secondary middle bordered" data-modal-id="">
                            <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Đăng ký</span></button>
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="ModalAuth-wrapper-item">
                    <div class="owl-carousel ModalAuth-carousel" id="ModalRegister-carousel">
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ModalAuth Modal" id="ModalReset">
    <div class="Modal-overlay"> </div>
    <div class="Modal-main" style="max-width: 107.4rem;">
        <div class="Modal-body">
            <div class="ModalAuth-wrapper flex">
                <div class="ModalAuth-wrapper-item">
                    <form class="ModalAuth-form flex flex-col" action="{{ route('front.sendmail') }}" method="POST">
                        <div class="ModalAuth-form-logo"> <img src="{{ asset('frontend/assets/images/logo.svg') }}" alt=""></div>
                        <h3 class="ModalAuth-form-title">Quên mật khẩu</h3>
                        <div class="noty_error"></div>
                        <div class="Input small bordered">
                            <input name="forget_email" id="forget_email" class="Input-control" type="email" placeholder="Nhập email">
                            <label id="forget_email-error" class="error" for="register_email" style="display: none"></label>
                        </div>
                        <div class="Button secondary middle bordered" data-modal-id="">
                            <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Gửi</span></button>
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="ModalAuth-wrapper-item">
                    <div class="owl-carousel ModalAuth-carousel" id="ModalReset-carousel">
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ModalAuth-carousel-item flex flex-col items-center justify-center">
                                <div class="ModalAuth-carousel-item-bg"> <img src="{{ asset('frontend/assets/images/image-modal-auth.png') }}" alt=""></div>
                                <div class="ModalAuth-carousel-item-title flex items-center justify-center">
                                    <h2>Chào mừng tới</h2>
                                    <span>KingStudy</span>
                                </div>
                                <div class="ModalAuth-carousel-item-info">
                                    <div class="ModalAuth-content style-content text-center">
                                        <p>KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ sơ, thủ tục.</p>
                                        <ul>
                                            <li>10 năm kinh nghiệm tư vấn và kết nối</li>
                                            <li>Tư vấn tận tình, chi tiết</li>
                                            <li>Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ModalFeedBack Modal" id="ModalFeedBack">
    <div class="Modal-overlay"> </div>
    <div class="Modal-main">
        <div class="Modal-header">
            Feedback
            <div class="Modal-close Modal-header-close"><img src="{{asset('frontend/assets/icons/icon-close.svg')}}" alt=""></div>
        </div>
        <div class="Modal-body">
            <iframe width="100%" height="500" src="#" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="Card ProfilePage-table-content">
    <div class="Card-header text-center">Tài khoản</div>
    <div class="Card-body">
        <ul class="ProfilePage-table-content-list">
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'formProfile' ? 'active' : ''}}" href="{{ route('formProfile') }}">Tài khoản của bạn</a></li>
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'theodoiHoSo' ? 'active' : ''}}" href="{{ route('theodoiHoSo') }}">Theo dõi hồ sơ</a></li>
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'manageProfile' ? 'active' : ''}}" href="{{ route('manageProfile') }}">Quản lý hồ sơ</a></li>
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'listWishlist' ? 'active' : ''}}" href="{{ route('listWishlist') }}">Trường yêu thích</a></li>
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'dieukhoan' ? 'active' : ''}}" href="{{ route('dieukhoan') }}">Điều khoản chính sách</a></li>
            <li class="ProfilePage-table-content-list-item"> <a class="{{\Request::route()->getName() == 'changePassWord' ? 'active' : ''}}" href="{{ route('changePassWord') }}">Đổi mật khẩu</a></li>
            <li class="ProfilePage-table-content-list-item"> <span class="js-open-modal" data-modal-id="#ModalLogout">Đăng xuất</span></li>
        </ul>
    </div>
</div>

@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
    <div class="ProfilePage">
        <div class="container">
            <div class="ProfilePage-wrapper flex flex-wrap">
                <div class="ProfilePage-wrapper-item">
                    @include("front::myAccount.sidebar")
                </div>
                <div class="ProfilePage-wrapper-item">
                      <div class="ChangePassword">
                        <div class="Card"> 
                          <div class="Card-header text-center">THay đổi mật khẩu mới</div>
                          <div class="Card-body">
                            <form id="frm_change_pass" class="ChangePassword-form" action="{{route('changePassWord.post')}}" method="POST">
                              <div class="ChangePassword-form-logo"> <img src="./assets/images/logo.svg" alt=""></div>
                              <div class="ChangePassword-form-control flex flex-wrap"> 
                                <div class="ChangePassword-form-item">
                                  <div class="Input small bordered">
                                    <input class="Input-control" type="password" id="password_old" name="password_old" placeholder="Mật khẩu cũ">
                                    <label class="error">{!! $errors->first("password_old") !!}</label>
                                  </div>
                                </div>
                                <div class="ChangePassword-form-item">
                                  <div class="Input small bordered">
                                    <input class="Input-control" type="password" id="password_new" name="password_new" placeholder="Mật khẩu mới">
                                    <label class="error">{!! $errors->first("password_new") !!}</label>
                                  </div>
                                </div>
                                <div class="ChangePassword-form-item">
                                  <div class="Input small bordered">
                                    <input class="Input-control" type="password" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu mới">
                                    <label class="error">{!! $errors->first("password_confirm") !!}</label>
                                  </div>
                                </div>
                              </div>
                              <div class="ChangePassword-form-submit flex justify-center">
                                <div class="Button small" data-modal-id="">
                                  <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Xác nhận</span>
                                  </button>
                                </div>
                              </div>
                              @csrf
                            </form>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('after_scripts')
<script type="text/javascript">
        $(document).ready(function() {
            $('#frm_change_pass').validate({
                ignore: ".ignore",
                rules: {
                    password_old: "required",
                    password_new: "required",
                    password_confirm: {
                        equalTo: "#password_new"
                    }
                },
                messages: {
                    password_old: "Nhập mật khẩu cũ",
                    password_new: "Nhập mật khẩu mới",
                    password_confirm: "Mật khẩu không trùng khớp",
                },
                submitHandler: function(form) {
                    ajax_loading(false);
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        if (res.rs) {
                            toastr.success('Đổi mật khẩu thành công', 'Success')
                            if (res.redirect_url) {
                                location.href = res.redirect_url;
                            }
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@stop

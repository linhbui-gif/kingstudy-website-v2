<script>
    function removeItem(t){
        var id = $(t).data("id");
        // $(t).parents(".Compare-school-wrapper-logo-item").remove();
        window.location.href = "/xoa-so-sanh?id=" + id;
    }
</script>
<script type="text/javascript">
    $("#open_frm_contact").on("click", function () {
     var schoolId = $(this).attr('data-id');
     $("#ModalContactInformation form #frm_contact_school").val(schoolId);
    });

    $('#ModalAuth .ModalAuth-form').validate({
        ignore: ".ignore",
        rules: {
            email: "required",
            password: "required",
        },
        messages: {
            email: "Email không được rỗng",
            password: "Mật khẩu không được rỗng",
        },
        submitHandler: function (form) {
            // do other things for a valid form
            var data = $(form).serializeArray();
            var url = $(form).attr('action');
            console.log('data', data)
            request_ajax(url, data, "POST", function (res) {
                ajax_loading(false);
                if (res.rs == 1) {
                    $(".noty_error").html('<div class="alert alert-danger" role="alert">'+res.msg+'</div>');
                }else if(res.rs == 2){
                    window.location = res.redirect_url;
                } else if (res.errors) {
                    $.each(res.errors, function (key, msg) {
                        $('#' + key + '-error').html(msg).show();
                    });
                }
            });
            return false;
        }
    });
    $('#ModalRegister form').validate({
        ignore: ".ignore",
        rules: {
            register_email: "required",
            register_password: "required",
            password_confirmation: {
                equalTo: "#register_password"
            }
        },
        messages: {
            register_email: "Email không hợp lệ",
            register_password: "Mật khẩu không được rỗng",
            password_confirmation: "Mật khẩu không trùng khớp"
        },
        submitHandler: function (form) {
            // do other things for a valid form
            var data = $(form).serializeArray();
            var url = $(form).attr('action');
            request_ajax(url, data, "POST", function (res) {
                ajax_loading(false);
                if (res.rs == 1) {
                    location.reload();
                } else if (res.errors) {
                    $.each(res.errors, function (key, msg) {
                        $('#' + key + '-error').html(msg[0]).show();
                    });
                }
            });
            return false;
        }
    });
    $('#ModalContactInformation form').validate({
        ignore: ".ignore",
        rules: {
            name: "required",
            phone: "required",
            national: "required",
            level_course: "required",
            email: "required",
            ielts: "required",
        },
        messages: {
            name: "Vui lòng nhập họ & tên",
            phone: "Vui lòng nhập số điện thoại",
            national: "Vui lòng chọn quốc gia du học",
            level_course: "Vui lòng chọn bậc học",
            email: "Email không hợp lệ",
            ielts: "Vui lòng chọn mục ielts",
        },
        submitHandler: function (form) {
            // do other things for a valid form
            var data = $(form).serializeArray();
            var url = $(form).attr('action');
            request_ajax(url, data, "POST", function (res) {
                ajax_loading(false);
                if (res.rs === 1) {
                    $('#btn_contact_frm').attr('disabled',true);
                    toastr.success('Gửi thành công..', 'Success')
                    window.location = res.redirect_url;
                } else if (res.errors) {
                    $.each(res.errors, function (key, msg) {
                        $('#' + key + '-error').html(msg[0]).show();
                    });
                }
            });
            return false;
        }
    });

    $('#frm_contact_footer').validate({
        ignore: ".ignore",
        rules: {
            name: "required",
            email: "required",
        },
        messages: {
            name: "Vui lòng nhập họ & tên",
            email: "Email không hợp lệ",
        },
        submitHandler: function (form) {
            // do other things for a valid form
            console.log(form);
            var data = $(form).serializeArray();
            var url = $(form).attr('action');
            request_ajax(url, data, "POST", function (res) {
                ajax_loading(false);
                if (res.rs === 1) {
                    $('#btn_contact_frm_footer').attr('disabled',true);
                    toastr.success('Gửi thành công..', 'Success')
                    window.location = res.redirect_url;
                } else if (res.errors) {
                    $.each(res.errors, function (key, msg) {
                        $('#' + key + '-error').html(msg[0]).show();
                    });
                }
            });
            return false;
        }
    });

    $('#contact_frm_duhoc').validate({
        ignore: ".ignore",
        rules: {
            name: "required",
            phone: "required",
            national: "required",
            level_course: "required",
            email: "required",
            ielts: "required",
        },
        messages: {
            name: "Vui lòng nhập họ & tên",
            phone: "Vui lòng nhập số điện thoại",
            national: "Vui lòng chọn quốc gia du học",
            level_course: "Vui lòng chọn bậc học",
            email: "Email không hợp lệ",
            ielts: "Vui lòng chọn mục ielts",
        },
        submitHandler: function (form) {
            // do other things for a valid form
            var data = $(form).serializeArray();
            var url = $(form).attr('action');
            request_ajax(url, data, "POST", function (res) {
                 ajax_loading(false);
                if (res.rs === 1) {
                    $('#btn_contact_frm').attr('disabled',true);
                    toastr.success('Gửi thành công..', 'Success')
                    window.location = res.redirect_url;
                } else if (res.errors) {
                    $.each(res.errors, function (key, msg) {
                        $('#' + key + '-error').html(msg[0]).show();
                    });
                }
            });
            return false;
        }
    });
    document.addEventListener('scroll', function() {
        // Event handler code
    }, { passive: true });
</script>
<script type="text/javascript">
    $('.js-anchor-link').click(function(e){
        console.log('123')
        e.preventDefault();
        var target = $($(this).attr('href'));
        if(target.length){
            var scrollTo = (target.offset().top) - 200;
            $('body, html').animate({ scrollTop: scrollTo +'px'}, 400);
        }
    });
    $(window).scroll(function() {
        let scrollDistance = $(window).scrollTop();
        // Assign active class to nav links while scolling
        $('.page-section').each(function(i) {
            if ((($(this).position().top) - 250) <= scrollDistance) {
                $('.SchoolDetailPage-table-content-list-item .js-anchor-link.active').removeClass('active');
                $('.SchoolDetailPage-table-content-list-item .js-anchor-link').eq(i).addClass('active');
            }
        });
    }).scroll();
</script>

<script type="text/javascript">
	$(document).ready(function() {
        function formatNumberInput(n) {
              return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
        $("#job_salary").on('keyup', function(){
                let number = formatNumberInput($(this).val());
                $(this).val(number);
        });
        $('#UpdateProfile_frm')[0].reset();
        $('#UpdateProfile_frm').validate({
                ignore: ".ignore",
                // rules: {
                //     name: "required",birth_place:'required',gender:'required',permanent_address:'required',current_address:'required',time_at_address:'required',phone:'required',email:'required',identity_card:'required',identity_card_issued_by:'required',identity_card_date:'required',identity_card_expiration_date:'required',father_name:'required',father_birth_day:'required',father_current_address:'required',father_job:'required',father_phone:'required',mother_name:'required',mother_birth_day:'required',mother_current_address:'required',mother_job:'required',mother_phone:'required',degree:'required',
                //         is_gone_abroad:'required',is_gone_uk:'required',is_fail_visa:'required',is_warned_country:'required',
                //         is_denine:'required',commit:'required',private:'required',is_work:'required',is_worked_2:'required',is_ielts:'required',marital_status:'required',is_relative_study_abroad:'required',other_passport:'required',passport:'required',passport_issued_by:'required',passport_date:'required',passport_expiration_date:'required'
                //
                // },
                // messages: {
                //     name: "Vui lòng nhập tên ",birth_day:'Vui lòng điền thông tin này',birth_place:'Vui lòng điền thông tin này',gender:'Vui lòng điền thông tin này',permanent_address:'Vui lòng điền thông tin này',current_address:'Vui lòng điền thông tin này',time_at_address:'Vui lòng điền thông tin này',phone:'Vui lòng điền thông tin này',email:'Vui lòng điền thông tin này',identity_card:'Vui lòng điền thông tin này',identity_card_issued_by:'Vui lòng điền thông tin này',identity_card_date:'Vui lòng điền thông tin này',identity_card_expiration_date:'Vui lòng điền thông tin này',father_name:'Vui lòng điền thông tin này',father_birth_day:'Vui lòng điền thông tin này',father_current_address:'Vui lòng điền thông tin này',father_job:'Vui lòng điền thông tin này',father_phone:'Vui lòng điền thông tin này',mother_name:'Vui lòng điền thông tin này',mother_birth_day:'Vui lòng điền thông tin này',mother_current_address:'Vui lòng điền thông tin này',mother_job:'Vui lòng điền thông tin này',mother_phone:'Vui lòng điền thông tin này',degree:'Vui lòng điền thông tin này',
                //         is_gone_abroad:'Vui lòng điền thông tin này',is_gone_uk:'Vui lòng điền thông tin này',
                //         is_fail_visa:'Vui lòng điền thông tin này',is_warned_country:'Vui lòng điền thông tin này',
                //         is_denine:'Vui lòng điền thông tin này',commit:'Vui lòng điền thông tin này',is_work:'Vui lòng điền thông tin này',
                //         is_ielts:'Vui lòng điền thông tin này',marital_status:'Vui lòng điền thông tin này',is_relative_study_abroad:'Vui lòng điền thông tin này',is_worked_2:'Vui lòng điền thông tin này',other_passport:'Vui lòng điền thông tin này',
                //         passport:'Vui lòng điển thông tin này',passport_issued_by:'Vui lòng điển thông tin này',passport_date:'Vui lòng điển thông tin này',passport_expiration_date:'Vui lòng điển thông tin này'
                // },
                submitHandler: function (form) {
                    // do other things for a valid form
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        $('#btn-submit_').attr('disabaled',true);
                        if (res.rs === 1) {
                            toastr.success('Cập nhật thành công', 'Success')
                            if (res.redirect_url) {
                                location.href = res.redirect_url;
                            }
                        } else if (res.rs === 0) {
                            toastr.error('Cập nhật thất bại', 'Error!')
                            // $.each(res.errors, function (key, msg) {
                            //     $('#' + key + '-error').html(msg).show();
                            // });
                        }
                    });
                    return false;
                }
            });
    })
</script>

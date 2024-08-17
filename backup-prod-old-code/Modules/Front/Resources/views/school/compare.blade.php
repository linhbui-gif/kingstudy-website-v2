@extends('front::layouts.master')
@php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
@endphp
@section('content')
    <div class="ModalSubmitFileSuccess Modal"  id="ModalCoHoSo">
        <div class="Modal-overlay"> </div>
        <div class="Modal-main" style="max-width: 62.8rem;">
            <div class="Modal-header">
                Thông báo</div>
            <div class="Modal-body">
                <div class="style-content">
                    <p class="text-center">Bạn đã có hồ sơ trước đó.<br>Vui lòng nộp ngay !<br> Hoặc <br> Có thể tạo hồ sơ mới</p>
                    <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                        <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                            <div class="Button secondary small" data-modal-id="">
                                <a id="btnCreateNew" href="#" class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Tạo mới</span>
                                </a>
                            </div>
                        </div>
                        <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                            <div class="Button Modal-close small" data-modal-id="">
                                <button id="btnNopNgay" data-school-id="" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Nộp ngay</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ModalSubmitFileSuccess Modal"  id="ModalKhongHoSo">
        <div class="Modal-overlay"> </div>
        <div class="Modal-main" style="max-width: 62.8rem;">
            <div class="Modal-header">
                THông báo</div>
            <div class="Modal-body">
                <div class="style-content">
                    <p class="text-center">Bạn chưa có hồ sơ trước đó <br>Vui lòng tiếp tục để nộp hồ sơ !</p>
                    <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                        <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                            <div class="Button secondary small" data-modal-id="">
                                <button  class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Hủy</span>
                                </button>
                            </div>
                        </div>
                        <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                            <div class="Button Modal-close small" data-modal-id="">
                                <a id="btnContinute" href="#" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp tục</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="CompareSchoolPage">
        <div class="ModalContactInformation Modal" id="ModalContactInformation">
            <div class="Modal-overlay"> </div>
            <div class="Modal-main">
                <div class="Modal-header">
                    Thông tin liên hệ
                    <div class="Modal-close Modal-header-close"><img src="./assets/icons/icon-close.svg" alt=""></div>
                </div>
                <div class="Modal-body">
                    <form class="ModalContactInformation-form" action="#">
                        <div class="ModalContactInformation-form-control flex flex-wrap">
                            <div class="ModalContactInformation-form-item">
                                <div class="Input small bordered">
                                    <input class="Input-control" type="text" placeholder="Tên của bạn">
                                </div>
                            </div>
                            <div class="ModalContactInformation-form-item">
                                <div class="Select small bordered">
                                    <select class="Select-control">
                                        <option value="">Quốc gia du học</option>
                                    </select>
                                    <div class="Select-arrow"> <img src="./assets/icons/icon-angle-down.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="ModalContactInformation-form-item">
                                <div class="Input small bordered">
                                    <input class="Input-control" type="text" placeholder="Số điện thoại">
                                </div>
                            </div>
                            <div class="ModalContactInformation-form-item">
                                <div class="Select small bordered">
                                    <select class="Select-control">
                                        <option value="">Bậc học</option>
                                    </select>
                                    <div class="Select-arrow"> <img src="./assets/icons/icon-angle-down.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="ModalContactInformation-form-item">
                                <div class="Input small bordered">
                                    <input class="Input-control" type="text" placeholder="Email">
                                </div>
                            </div>
                            <div class="ModalContactInformation-form-item">
                                <div class="Select small bordered">
                                    <select class="Select-control">
                                        <option value="">Ielts</option>
                                    </select>
                                    <div class="Select-arrow"> <img src="./assets/icons/icon-angle-down.svg" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="ModalContactInformation-form-submit flex justify-center">
                            <div class="Button secondary small" data-modal-id="">
                                <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Gửi thông tin</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <section class="Banner">
            <div class="Banner-wrapper">
                <div class="Banner-image" style="height: 26.4rem;"><img src="{{ asset('frontend/assets/images/image-banner-school-list.png') }}" alt=""></div>
                <div class="Banner-overlay"></div>
                <h1 class="Banner-text">So sánh trường</h1>
            </div>
        </section>
        <div class="container">
        @if(!empty($listSchool))
            <div class="CompareSchoolPage-wrapper">
                <div class="CompareSchoolPage-table">
                    <table>
                        <thead>
                        <tr>
                            <td>
                                <div class="CompareSchoolPage-table-download">
                                    <div class="CompareSchoolPage-table-download-icon"> <img src="{{ asset('frontend/assets/icons/icon-pdf.svg') }}" alt=""></div>
                                    <div class="CompareSchoolPage-table-download-btn">
                                        <div id="exportPDF" class="Button small bordered" data-modal-id="">
                                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-icon"><img src="{{ asset('frontend/assets/icons/icon-download.svg') }}" alt=""></span><span class="Button-control-title">Xuất PDF</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @foreach($listSchool as $school)
                            <td>
                                <div class="SchoolBlock even">
                                    <div class="SchoolBlock-image"> <a href="{{ route('details_school', ['slug' => $school->slug]) }}"> <img src="{{ asset($school->logo) }}" alt=""></a></div>
                                    <div class="line"></div>
                                    <div class="SchoolBlock-info"><a class="SchoolBlock-title" href="{{ route('details_school', ['slug' => $school->slug]) }}">{{ $school->name }}</a>
                                        <p class="SchoolBlock-description">{{ $school->heading }}</p>
                                    </div>
                                </div>
                            </td>
                            @endforeach


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Giới thiệu chung</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_general_infor !!}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_city !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Thông tin nổi bật</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_highlight_infor !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Chương trình học</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_study_program !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cơ sở vật chất</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_infrastructure !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Học Phí</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_tuition !!}</td>
                            @endforeach
                        </tr>

                        <tr>
                            <td>Học bổng</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_scholarship !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Điều kiện đầu vào</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_required !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Feedback</td>
                            @foreach($listSchool as $school)
                                <td>{!! $school->summary_feed_back !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td> </td>
                            @foreach($listSchool as $school)
                            <td>
                                <div class="CompareSchoolPage-table-btns">
                                    <div class="Button js-open-modal small bordered" data-modal-id="#ModalContactInformation">
                                        <button data-id="{{@$school->id}}" id="open_frm_contact" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Liên hệ tư vấn</span>
                                        </button>
                                    </div>
                                    <div class="Button secondary small bordered" data-modal-id="">
                                        <button data-school-id="{{ $school->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo({{ $school->id }})" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
                <div class="not-result">
                    <img src="https://ebook-demo.netlify.app/static/media/image-empty.2b0b05a6.png" style="margin:auto" alt="">
                </div>
        @endif
        </div>
    </div>

@endsection

@section('after_scripts')

    <script>
        function openModelCoHoSo(schoool_id){
            var link = "{{ route('formNopHoSo') }}?id=" + schoool_id;
            $("#ModalCoHoSo").addClass("active");
            $("#btnCreateNew").attr("href", link);
        }
        function openModelKhongHoSo(t){
            var school_id = $(t).data("school-id");
            $("#btnContinute").attr("href", '{{ route('formNopHoSo') }}?id=' + school_id);
            $("#ModalKhongHoSo").addClass("active");
        }
        function openModelLogin(){
            $(".Modal").removeClass("active");
            $("#ModalAuth").addClass("active");
            $("#ModalAuth").style.display = 'block';
            const modal = document.querySelector("#ModalAuth");
            const overlay = modal.querySelector(".Modal-overlay");
            const close = modal.querySelectorAll(".Modal-close");

            overlay.addEventListener("click", () => {
                modal.classList.remove("active");
                modal.style.display = 'none';
            });
            close.forEach((item) =>
                item.addEventListener("click", () => {
                    modal.classList.remove("active");
                    modal.style.display = 'none';
                })
            );
        }


        $(document).ready(function() {

            $(".add_wishlish").on('click', function(){
                var auth = $(this).data('auth');
                var id = $(this).data('id');
                if(auth != 1){
                    openModelLogin();
                }else{
                    $.ajax({
                        url: "/add-wishlist?id=" + id,
                        success: function(data){
                            $("#notify_title").html(data.msg);
                            $("#ModalWishList").addClass("active");
                        }
                    })
                }
            })
            $(".add-compare").on('click', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: "/them-so-sanh?id=" + id,
                    success: function(data){
                        $("#notify_title_compare").html(data.msg);
                        $("#ModalCompare").addClass("active");
                    }
                })
            })

            $(".btn-canel").on("click", function(){
                $(this).parents(".Modal").removeClass("active");
            });

            $("#btnNopNgay").on("click", function(){
                var school_id = $(this).data("school-id");
                ajax_loading(true);
                $.ajax({
                    url: "{{ route('nopHoSoNgay') }}?school_id=" +  school_id,
                    dataType: "json",
                    success: function(data){
                        ajax_loading(false);
                        $(".Modal").removeClass("active");
                        if(data.rs == 1){
                            $("#ModalSuccess").addClass("active");
                        }
                    }
                });
            });
        });

        $("#exportPDF").on("click", function(){
            window.open('/export-pdf', '_blank');
        })
    </script>

@endsection

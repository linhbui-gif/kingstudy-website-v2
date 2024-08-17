@php
    $countries       = \Modules\Admin\Entities\Country::select('id','name')->get()->toArray();
    $levelcourses  = \Modules\Admin\Entities\LevelCourse::select('id','name')->get()->toArray();
@endphp
<section data-bg="{{asset('frontend/assets/images/banner_du_hoc.png')}}" class="form__contact section__pd bg-cover rocket-lazyload entered lazyloaded" id="tuvan" style="background-image: url({{asset('frontend/assets/images/banner_du_hoc.png')}});" data-ll-status="loaded">
    <div class="container">
        <div class="main-form ">
            <p>
                Bạn muốn đi du học ? </p>
            <form action="{{ route('create_contacts') }}" method="POST" class="support-register-form" id="contact_frm_duhoc">
                <div class="row gutter-12">
                    <div class="col-md-6">
                        <div class="Input small bordered">
                            <input class="Input-control" name="name" type="text" placeholder="Tên của bạn">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Select small">
                            <select class="Select-control" name="national">
                                <option value="">Quốc gia du học</option>
                                @if(isset($countries))
                                    @foreach($countries as $countrie)
                                        <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="Select-arrow"> <img src="http://king-study.loc/frontend/assets/icons/icon-angle-down.svg" alt=""></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Input small bordered">
                            <input class="Input-control" type="text" placeholder="Số điện thoại" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Select small">
                            <select class="Select-control" name="level_course">
                                <option value="">Bậc học</option>
                                @if(isset($levelcourses))
                                    @foreach($levelcourses as $levelcourses)
                                        <option value="{{$levelcourses['id']}}">{{$levelcourses['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="Select-arrow"> <img src="http://king-study.loc/frontend/assets/icons/icon-angle-down.svg" alt=""></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Input small">
                            <input class="Input-control" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Select small">
                            <select class="Select-control" name="ielts">
                                <option value="">IELTS</option>
                                <option value="5.5">Dười 5.5</option>
                                <option value="6">Từ 5.5 đến 7.0</option>
                                <option value="7">Trên 7.0</option>
                            </select>
                            <div class="Select-arrow"> <img src="http://king-study.loc/frontend/assets/icons/icon-angle-down.svg" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="row gutter-12 form-button">
                    <div class="col-md-6">
                        <button class="now-btn form-btn saleforce_submit btn" type="submit">
                                <span>
                                Liên hệ ngay <span class="loading d-none"><svg width="20px" version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                <path fill="#fff" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
                                  c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                                </path>
                                <path fill="#fff" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
                                  c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="-360 50 50" repeatCount="indefinite"></animateTransform>
                                </path>
                                <path fill="#fff" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
                                  L82,35.7z">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                                </path>
                                </svg></span>
                                </span>
{{--                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00001 13.4001C8.69739 13.4001 10.3253 12.7258 11.5255 11.5256C12.7257 10.3253 13.4 8.69748 13.4 7.0001C13.4 5.30271 12.7257 3.67485 11.5255 2.47461C10.3253 1.27438 8.69739 0.600098 7.00001 0.600098C5.30262 0.600098 3.67476 1.27438 2.47452 2.47461C1.27429 3.67485 0.600006 5.30271 0.600006 7.0001C0.600006 8.69748 1.27429 10.3253 2.47452 11.5256C3.67476 12.7258 5.30262 13.4001 7.00001 13.4001V13.4001ZM9.96561 6.4345L7.56561 4.0345C7.41472 3.88877 7.21264 3.80814 7.00289 3.80996C6.79313 3.81178 6.59248 3.89592 6.44415 4.04424C6.29582 4.19257 6.21169 4.39322 6.20987 4.60298C6.20804 4.81273 6.28868 5.01482 6.43441 5.1657L7.46881 6.2001H4.60001C4.38783 6.2001 4.18435 6.28438 4.03432 6.43441C3.88429 6.58444 3.80001 6.78792 3.80001 7.0001C3.80001 7.21227 3.88429 7.41575 4.03432 7.56578C4.18435 7.71581 4.38783 7.8001 4.60001 7.8001H7.46881L6.43441 8.8345C6.358 8.90829 6.29705 8.99657 6.25512 9.09417C6.2132 9.19178 6.19113 9.29675 6.19021 9.40298C6.18928 9.5092 6.20952 9.61454 6.24975 9.71286C6.28997 9.81118 6.34938 9.9005 6.42449 9.97561C6.4996 10.0507 6.58893 10.1101 6.68724 10.1504C6.78556 10.1906 6.8909 10.2108 6.99713 10.2099C7.10335 10.209 7.20833 10.1869 7.30593 10.145C7.40353 10.1031 7.49181 10.0421 7.56561 9.9657L9.96561 7.5657C10.1156 7.41567 10.1998 7.21223 10.1998 7.0001C10.1998 6.78797 10.1156 6.58452 9.96561 6.4345V6.4345Z" fill="white"></path>--}}
{{--                            </svg>--}}
                        </button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-btn call-btn">
                            <a href="tel:19007211" data-wpel-link="internal" target="_self" rel="follow noopener noreferrer">
                                056 999 9595 (Hotline) </a>
                        </div>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</section>

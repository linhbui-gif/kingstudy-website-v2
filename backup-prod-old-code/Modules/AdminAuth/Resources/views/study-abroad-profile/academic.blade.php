        <div class="UpdateInfoSturyAbroad-step">
                <div class="Card"> 
                  <div class="Card-header text-center">Thông tin học thuật </div>
                  <div class="Card-body" style="padding: 2rem;">
                    <div class="EditProfile-form-control flex flex-wrap"> 
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Bằng cấp cao nhất:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['degree']}}"
                          type="text" name="degree" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Bạn đã đi làm chưa:</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value ="0" 
                              {{@$infor['is_work'] === 0 ? 'checked': ''}}
                              name="is_work">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['is_work'] === 1 ? 'checked': ''}}
                              name="is_work">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item full vertical">
                        {{-- <div class="ProfilePage-label"><span>Vui lòng cung cấp thông tin bậc học gần nhất.</span></div> --}}
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên trường:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['degree_school_name']}}"
                          type="text" name="degree_school_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Chuyên ngành:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['degree_major']}}"
                          type="text" name="degree_major" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Niên khóa:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['degree_school_year']}}"
                          type="text" name="degree_school_year" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Địa chỉ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['degree_address']}}"
                           type="text" name="degree_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item full vertical">
                        {{-- <div class="ProfilePage-label"><span>Vui lòng cung cấp thông tin 2 người giới thiệu</span></div> --}}
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Họ tên (1):</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_1_name']}}"
                          type="text" name="presenter_1_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Chức vụ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_1_position']}}"
                          type="text" name="presenter_1_position" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_1_email']}}"
                          type="text" name="presenter_1_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_1_phone']}}"
                          type="text" name="presenter_1_phone" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Họ tên (2):</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_2_name']}}"
                          type="text" name="presenter_2_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Chức vụ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_2_position']}}"
                          type="text" name="presenter_2_position" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_2_email']}}"
                          type="text" name="presenter_2_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['presenter_2_phone']}}"
                           type="text" name="presenter_2_phone" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Bạn đã thi IELTS chưa:</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['is_ielts'] === 0 ? 'checked': ''}}
                              name="is_ielts">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['is_ielts'] === 1 ? 'checked': ''}}
                              name="is_ielts">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Overall</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_overall']}}"
                          type="text" name="ielts_overall" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày thi</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['ielts_date']))
                            value="{{date('d-m-Y',strtotime($infor['ielts_date']))}}" 
                           @endif
                          type="text" name="ielts_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Reading:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_reading']}}"
                          type="number" min="1" max="10" name="ielts_reading" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Listening:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_listening']}}"
                          type="number" min="1" max="10" name="ielts_listening" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Writing:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_writing']}}"
                          type="number" min="1" max="10" name="ielts_writing" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Speaking:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_speaking']}}"
                          type="number" min="1" max="10" name="ielts_speaking" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Test Report Form No:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['ielts_test_report_form']}}"
                          type="text" name="ielts_test_report_form" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item"></div>
                     {{--  <div class="EditProfile-form-item EditProfile-form-item-submit flex items-center justify-end">
                        <div class="Button UpdateInfoSturyAbroad-step-submit middle" data-modal-id="">
                          <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp theo</span>
                          </button>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
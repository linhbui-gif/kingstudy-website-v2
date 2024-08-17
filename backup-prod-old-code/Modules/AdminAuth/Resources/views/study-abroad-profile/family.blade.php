    <div class="UpdateInfoSturyAbroad-step">
                <div class="Card"> 
                  <div class="Card-header text-center">Thông tin gia đình</div>
                  <div class="Card-body" style="padding: 2rem;">
                    <div class="EditProfile-form-control flex flex-wrap"> 
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Họ và tên bố:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['father_name']}}"
                          type="text" name="father_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['father_birth_day']))
                            value="{{date('d-m-Y',strtotime($infor['father_birth_day']))}}" 
                           @endif
                          type="text" name="father_birth_day" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['father_current_address']}}"
                          type="text" name="father_current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Nghề nghiệp:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['father_job']}}"
                          type="text" name="father_job" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['father_phone']}}"
                          type="text" name="father_phone" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['father_phone']}}"
                          type="text" name="father_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Họ và tên mẹ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['mother_name']}}"
                          type="text" name="mother_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['mother_birth_day']))
                            value="{{date('d-m-Y',strtotime($infor['mother_birth_day']))}}" 
                           @endif
                          type="text" name="mother_birth_day" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['mother_current_address']}}"
                          type="text" name="mother_current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Nghề nghiệp:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['mother_job']}}"
                           type="text" name="mother_job" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['mother_phone']}}"
                          type="text" name="mother_phone" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['mother_email']}}"
                          type="text" name="mother_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">TÌnh trang hôn nhân:</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['marital_status'] === 1 ? 'checked': ''}}
                               name="marital_status">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Kết hôn</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['marital_status'] === 0 ? 'checked': ''}}
                              name="marital_status">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Độc thân</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên vợ/chồng:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['spouse_name']}}"
                          type="text" name="spouse_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['spouse_birth_day']))
                            value="{{date('d-m-Y',strtotime($infor['spouse_birth_day']))}}" 
                           @endif
                          type="text" name="spouse_birth_day"  placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['spouse_birth_place']}}"
                          type="text" name="spouse_birth_place" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc tịch</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['spouse_nationality']}}"
                          type="text" name="spouse_nationality" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['spouse_current_address']}}"
                          type="text" name="spouse_current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên con 1:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_1_name']}}"
                          type="text" name="child_1_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['child_1_birth_day']))
                            value="{{date('d-m-Y',strtotime($infor['child_1_birth_day']))}}" 
                           @endif
                          type="text" name="child_1_birth_day" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_1_birth_place']}}"
                          type="text" name="child_1_birth_place" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc tịch</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_1_nationality']}}"
                          type="text" name="child_1_nationality" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_1_current_address']}}"
                           type="text" name="child_1_current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên con 2:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_2_name']}}"
                          type="text" name="child_2_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['child_2_birth_day']))
                            value="{{date('d-m-Y',strtotime($infor['child_2_birth_day']))}}" 
                           @endif
                          type="text" name="child_2_birth_day" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi sinh:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_2_birth_place']}}"
                          type="text" name="child_2_birth_place" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc tịch</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_2_nationality']}}"
                          type="text" name="child_2_nationality" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['child_2_current_address']}}"
                          type="text" name="child_2_current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item"></div>
                      {{-- <div class="EditProfile-form-item EditProfile-form-item-submit flex items-center justify-end">
                        <div class="Button UpdateInfoSturyAbroad-step-submit middle" data-modal-id="">
                          <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp theo</span>
                          </button>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
<div class="UpdateInfoSturyAbroad-step">
                <div class="Card"> 
                  <div class="Card-header text-center">Thông tin cá nhân</div>
                  <div class="Card-body" style="padding: 2rem;">
                    <div class="EditProfile-form-control flex flex-wrap"> 
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên của bạn:</div>
                        <div class="Input small bordered">
                          <input required class="Input-control" type="text" name='name' value="{{@$infor['name']}}" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                        <div class="Input small bordered">
                          <input required class="Input-control datepicker" 
                          @if(isset($infor['birth_day']))
                          value="{{date('d-m-Y',strtotime($infor['birth_day']))}}" 
                          @endif
                          type="text" name='birth_day' placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi sinh: </div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['birth_place']}}"
                          type="text" name="birth_place" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Giới tính: </div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['gender'] === 1 ? 'checked': ''}}
                              name="gender">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">
                                Nam
                              </div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['gender'] === 0 ? 'checked': ''}}
                              name="gender">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Nữ</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Địa chỉ thường trú (theo sổ hộ khẩu):</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['permanent_address']}}"
                          type="text" name="permanent_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical">
                        <div class="ProfilePage-label">Địa chỉ hiện tại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['current_address']}}"
                          type="text" name="current_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item full vertical">
                        <div class="ProfilePage-label">Thời gian ở tại địa chỉ này:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['time_at_address']}}"
                           type="text" name="time_at_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">SĐT cá nhân:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['phone']}}"
                           type="text" name="phone" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">SĐT thay thế:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['phone_2']}}"
                          type="text" name="phone_2" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['email']}}"
                          type="text" name="email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số CMND/CCCD:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['identity_card']}}"
                           type="text" name="identity_card" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi cấp</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['identity_card_issued_by']}}"
                          type="text" name="identity_card_issued_by" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày cấp:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker"
                           @if(isset($infor['identity_card_date']))
                            value="{{date('d-m-Y',strtotime($infor['identity_card_date']))}}" 
                           @endif
                          type="text" name="identity_card_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày hết hạn:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker"
                           @if(isset($infor['identity_card_expiration_date']))
                            value="{{date('d-m-Y',strtotime($infor['identity_card_expiration_date']))}}" 
                           @endif
                          type="text" name="identity_card_expiration_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số hộ chiếu:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['passport']}}"
                          type="text" name="passport" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi cấp</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['passport_issued_by']}}"
                          type="text" name="passport_issued_by" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày cấp:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker"
                           @if(isset($infor['passport_date']))
                            value="{{date('d-m-Y',strtotime($infor['passport_date']))}}" 
                           @endif
                          type="text" name="passport_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày hết hạn:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker"
                           @if(isset($infor['passport_expiration_date']))
                            value="{{date('d-m-Y',strtotime($infor['passport_expiration_date']))}}" 
                           @endif
                          type="text" name="passport_expiration_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn có hộ chiếu khác không</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['other_passport'] === 1 ? 'checked': ''}}
                              name="other_passport">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Có</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['other_passport'] === 0 ? 'checked': ''}}
                              name="other_passport">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Không</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số hộ chiếu:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['other_passport_card']}}"
                          type="text" name="other_passport_card" placeholder="Number">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Nơi cấp</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['other_passport_issued_by']}}"
                          type="text" name="other_passport_issued_by" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày cấp:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['other_passport_date']))
                            value="{{date('d-m-Y',strtotime($infor['other_passport_date']))}}" 
                           @endif
                          type="text" name="other_passport_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Ngày hết hạn:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker"
                          @if(isset($infor['other_passport_card_expiration_date']))
                            value="{{date('d-m-Y',strtotime($infor['other_passport_card_expiration_date']))}}" 
                           @endif
                           type="text" 
                          name="other_passport_card_expiration_date" placeholder="">
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
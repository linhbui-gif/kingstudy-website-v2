          <div class="UpdateInfoSturyAbroad-step">
                <div class="Card"> 
                  <div class="Card-header text-center">Thông tin lịch sử du lịch</div>
                  <div class="Card-body" style="padding: 2rem;">
                    <div class="EditProfile-form-control flex flex-wrap"> 
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn đã đi nước ngoài chưa</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0"
                              {{@$infor['is_gone_abroad'] === 0 ? 'checked': ''}}
                               name="is_gone_abroad">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['is_gone_abroad'] === 1 ? 'checked': ''}}
                               name="is_gone_abroad">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        {{-- <div class="ProfilePage-label"><span>Vui lòng cung cấp thông tin 10 năm gần nhất:</span></div> --}}
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc gia 1:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_1_nation']}}"
                          type="text" name="travel_history_1_nation" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian :</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['travel_history_1_time']))
                            value="{{date('d-m-Y',strtotime($infor['travel_history_1_time']))}}" 
                           @endif
                          type="text" name="travel_history_1_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Mục đích:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_1_purpose']}}"
                          type="text" name="travel_history_1_purpose" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc gia 2:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_2_nation']}}"
                          type="text" name="travel_history_2_nation" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian :</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['travel_history_2_time']))
                            value="{{date('d-m-Y',strtotime($infor['travel_history_2_time']))}}" 
                           @endif
                          type="text" name="travel_history_2_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Mục đích:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_2_purpose']}}"
                           type="text" name="travel_history_2_purpose" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc gia 3:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_3_nation']}}"
                          type="text" name="travel_history_3_nation" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian :</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['travel_history_3_time']))
                            value="{{date('d-m-Y',strtotime($infor['travel_history_3_time']))}}" 
                           @endif
                          type="text" name="travel_history_3_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Mục đích:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_3_purpose']}}"
                          type="text" name="travel_history_3_purpose" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc gia 4:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_4_nation']}}"
                          type="text" name="travel_history_4_nation" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian :</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['travel_history_4_time']))
                            value="{{date('d-m-Y',strtotime($infor['travel_history_4_time']))}}" 
                           @endif
                          type="text" name="travel_history_4_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Mục đích:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_4_purpose']}}"
                          type="text" name="travel_history_4_purpose" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Quốc gia 5:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_5_nation']}}"
                          type="text" name="travel_history_5_nation" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian :</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['travel_history_5_time']))
                            value="{{date('d-m-Y',strtotime($infor['travel_history_5_time']))}}" 
                           @endif
                          type="text" name="travel_history_5_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Mục đích:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['travel_history_5_purpose']}}"
                          type="text" name="travel_history_5_purpose" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn đã đi Anh Quốc chưa</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['is_gone_uk'] === 0 ? 'checked': ''}}
                              name="is_gone_uk">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['is_gone_uk'] === 1 ? 'checked': ''}}
                              name="is_gone_uk">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        {{-- <div class="ProfilePage-label"><span>Vui lòng cung cấp thông tin :</span></div> --}}
                      </div>
                      <div class="EditProfile-form-item flex items-center three">
                        <div class="ProfilePage-label">NI Number</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['uk_nl_number']}}"
                          type="number"  name="uk_nl_number" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center three">
                        <div class="ProfilePage-label">Thời gian:</div>
                        <div class="Input small bordered">
                          <input class="Input-control datepicker" 
                          @if(isset($infor['uk_date']))
                            value="{{date('d-m-Y',strtotime($infor['uk_date']))}}" 
                           @endif  
                          type="text" name="uk_date" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center three">
                        <div class="ProfilePage-label">BRP number:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['uk_brp_number']}}"
                           type="number" name="uk_brp_number" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn đã từng bị trượt visa nước nào chưa</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0"
                              {{@$infor['is_fail_visa'] === 0 ? 'checked': ''}}
                               name="is_fail_visa">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['is_fail_visa'] === 1 ? 'checked': ''}}
                              name="is_fail_visa">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Vui lòng cung cấp thông tin: thời gian - tên nước - loại visa bị từ chối</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['is_fail_visa_info']}}"
                          type="text" name="is_fail_visa_info" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn đã từng vi phạm pháp luật hay bị cảnh cáo tại quốc gia nào chưa?</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0"
                              {{@$infor['is_warned_country'] === 0 ? 'checked': ''}}
                               name="is_warned_country">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                              {{@$infor['is_warned_country'] === 1 ? 'checked': ''}}
                              name="is_warned_country">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Vui lòng cung cấp thông tin: lý do và quốc gia xảy ra sự việc:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['is_warned_country_info']}}"
                          type="text" name="is_warned_country_info" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn đã từng bị từ chối nhập cảnh tại quốc gia nào chưa?</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0"
                              {{@$infor['is_denine'] === 0 ? 'checked': ''}}
                               name="is_denine">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['is_denine'] === 1 ? 'checked': ''}}
                               name="is_denine">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        <div class="ProfilePage-label">Vui lòng cung cấp thông tin: lý do và quốc gia xảy ra sự việc:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['is_denine_info']}}"
                           type="text" name="is_denine_info" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn có người thân tại quốc gia du học không?</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                               {{@$infor['is_relative_study_abroad'] === 0 ? 'checked': ''}}
                              name="is_relative_study_abroad">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1" 
                               {{@$infor['is_relative_study_abroad'] === 1 ? 'checked': ''}}
                              name="is_relative_study_abroad">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item vertical full">
                        {{-- <div class="ProfilePage-label"><span>Vui lòng cung cấp thông tin :</span></div> --}}
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Họ và tên:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['relative_abroad_name']}}"
                           type="text" name="relative_abroad_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['relative_abroad_phone']}}"
                          type="text" name="relative_abroad_phone" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['relative_abroad_email']}}"
                           type="text" name="relative_abroad_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Địa chỉ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['relative_abroad_email']}}"
                          type="text" name="relative_abroad_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Bạn cam kết các thông tin khai ở trên hoàn toàn chính xác?</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['commit'] === 1 ? 'checked': ''}}
                               name="commit">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Có</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label auto">Thông tin của bạn sẽ được bảo mật theo <a href="#"><span>Chính sách bảo mật thông tin</span></a>:</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['private'] === 1 ? 'checked': ''}}
                               name="private">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Có</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item"></div>
                      {{-- <div class="EditProfile-form-item EditProfile-form-item-submit flex items-center justify-end">
                        <div class="Button middle">
                          <button id="btn-submit_" class="Button-control flex items-center justify-center" type="submit">
                            <span class="Button-control-title">Hoàn thành</span>
                          </button>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
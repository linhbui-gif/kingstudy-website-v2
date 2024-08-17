          <div class="UpdateInfoSturyAbroad-step">
                <div class="Card"> 
                  <div class="Card-header text-center">Thông tin công việc</div>
                  <div class="Card-body" style="padding: 2rem;">
                    <div class="EditProfile-form-control flex flex-wrap"> 
                      <div class="EditProfile-form-item flex items-center full">
                        <div class="ProfilePage-label">Bạn đã đi làm chưa:</div>
                        <div class="RadioGroup">
                          <div class="RadioGroup-wrapper flex items-center flex-wrap">
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="0" 
                              {{@$infor['is_worked_2'] === 0 ? 'checked': ''}}
                              name="is_worked_2">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Chưa</div>
                            </div>
                            <div class="Radio middle flex items-start">
                              <input type="radio" value="1"
                              {{@$infor['is_worked_2'] === 1 ? 'checked': ''}}
                               name="is_worked_2">
                              <div class="Radio-control"> </div>
                              <div class="Radio-label">Rồi</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Tên cơ quan:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_company_name']}}"
                           type="text" name="job_company_name" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Thời gian làm việc:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_working_time']}}"
                           type="text" name="job_working_time" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item full vertical">
                        <div class="ProfilePage-label">Địa chỉ :</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_address']}}"
                           type="text" name="job_address" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Số điện thoại:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_phone']}}"
                          type="number" name="job_phone" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Email:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_email']}}"
                          type="text" name="job_email" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Chức vụ:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{@$infor['job_position']}}"
                          type="text" name="job_position" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item flex items-center">
                        <div class="ProfilePage-label">Mức lương:</div>
                        <div class="Input small bordered">
                          <input class="Input-control" value="{{number_format(@$infor['job_salary'])}}"
                          type="text" name="job_salary" id="job_salary" placeholder="">
                        </div>
                      </div>
                      <div class="EditProfile-form-item"></div>
                      <div class="EditProfile-form-item EditProfile-form-item-submit flex items-center justify-end">
                        <div class="Button UpdateInfoSturyAbroad-step-submit middle" data-modal-id="">
                          <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp theo</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
@php
    $footer1 = \Modules\Admin\Entities\Widget::where('key_name', 'LIKE', 'footer_column_1')->first();
     $footer2 = \Modules\Admin\Entities\Widget::where('key_name', 'LIKE', 'footer_column_2')->first();
      $footer3 = \Modules\Admin\Entities\Widget::where('key_name', 'LIKE', 'footer_column_3')->first();
       $footer4 = \Modules\Admin\Entities\Widget::where('key_name', 'LIKE', 'footer_column_4')->first();
@endphp
<footer class="Footer">
      <div class="Footer-wrapper">
        <div class="container">
          <div class="Footer-list-wrapper flex flex-wrap">
            <div class="Footer-col">
              <div class="Footer-title">{{ $footer1->title }}</div>
              {!! $footer1->content !!}
            </div>
            <div class="Footer-col">
              <div class="Footer-title">{{ $footer2->title }}</div>
                {!! $footer2->content !!}
            </div>
            <div class="Footer-col">
              <div class="Footer-title">{{ $footer3->title }}</div>
                {!! $footer3->content !!}
            </div>
            <div class="Footer-col">
              <div class="Footer-title">{{ $footer4->title }}</div>
                {!! $footer4->content !!}
            </div>
          </div>
        </div>
        <form class="Footer-form" action="{{route('create_contacts')}}" id="frm_contact_footer" method="post">
          <div class="container">
            <div class="Footer-form-wrapper flex items-center flex-wrap">
              <div class="Footer-form-item">
                <div class="Footer-form-text">Đăng ký nhận tin</div>
              </div>
              <div class="Footer-form-item control">
                <div class="Input middle">
                  <input class="Input-control" id="email_frm_footer" required type="email" name='email' placeholder="Email của bạn">
                </div>
              </div>
              <div class="Footer-form-item control">
                <div class="Input middle">
                  <input class="Input-control" id="name_frm_footer" required type="text" name='name' placeholder="Tên của bạn">
                </div>
              </div>
              <div class="Footer-form-item">
                <div class="Button middle" data-modal-id="">
                  <button id="btn_contact_frm_footer" class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">GỬI</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="type" value="footer">
          @csrf
        </form>
        <div class="Footer-copyright">Copyright © By King Study</div>
      </div>
  </footer>


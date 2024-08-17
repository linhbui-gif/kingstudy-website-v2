@php
   $main_menu = Menu::get(7);
@endphp
<style>
   .Navigation-list-children-item .Navigation-list-item{
        text-transform: capitalize;
    }
   .Advisory-list-item-avatar img{
       border-radius: 50%;
   }
</style>
<nav class="Navigation">
  <div class="Navigation-overlay"> </div>
  <div class="container">
    <div class="Navigation-wrapper">
      <div class="Navigation-close"> <img src="{{asset('frontend/assets/icons/icon-x.svg')}}" alt=""></div>
      <form class="Header-search flex items-center" action="#">
        <input class="Header-search-control" type="text" placeholder="Tìm kiếm">
        <button class="Header-search-button" type="submit"><img src="{{asset('/frontend/assets/icons/icon-search-white.svg')}}" alt=""></button>
      </form>
      <div class="Navigation-list flex items-center justify-around">
          @if(!empty($main_menu))
          @foreach($main_menu as $menu)
              <div class="Navigation-list-wrapper {{$menu['id'] === 8 ? "has-dropdown" : ($menu['id'] === 9 ? "has-level1" : '')}}">
                  <a href="{{ is_numeric($menu['link']) ? route('getBlogByCategory',['id' => $menu['link']]) :  $menu['link'] }}" class="Navigation-list-item">{{ $menu['label'] }}</a>
                  @if($menu['id'] === 8)
                          <div class="Navigation-list-children-wrapper">
                              <div class="Navigation-list-children flex">
                                  <div class="Navigation-list-children-item">
                                      <a href="/quoc-gia-du-hoc/du-hoc-anh"><img src="https://kingstudy.vn/static/2023/03/08/19c6e2b0bb7d1f5593aade4c2e18c4d3d3f262e0.png" alt="Du học Anh"></a>
                                      <a class="Navigation-list-item" href="/quoc-gia-du-hoc/du-hoc-anh" title="Du học Anh">Du học Anh</a>
                                  </div>
                                  <div class="Navigation-list-children-item">
                                      <a href="/quoc-gia-du-hoc/du-hoc-uc"><img src="https://kingstudy.vn/static/2023/03/08/473d60bc7a71fa9fa30227537224d39bab4369f0.png" alt="Du học Úc"></a>
                                      <a class="Navigation-list-item" href="/quoc-gia-du-hoc/du-hoc-uc" title="Du học Úc">Du học Úc</a>
                                  </div>
                                  <div class="Navigation-list-children-item">
                                      <a href="/quoc-gia-du-hoc/du-hoc-my"><img src="https://kingstudy.vn/static/2023/03/13/eb4d7b44bce11337767bf6b64844a3719061b68f.png" alt="Du học Mỹ"></a>
                                      <a class="Navigation-list-item" href="/quoc-gia-du-hoc/du-hoc-my" title="Du học Mỹ">Du học Mỹ</a>
                                  </div>
                                  <div class="Navigation-list-children-item">
                                      <ul class="Navigation-list-children-item-list">
                                          <li class="children-item-list-text"><a href="/quoc-gia-du-hoc/du-hoc-canada" class="children-item-list-text-link">Du học Canada</a></li>
                                          <li class="children-item-list-text"><a href="/quoc-gia-du-hoc/du-hoc-ha-lan" class="children-item-list-text-link">Du học Hà Lan</a></li>
                                          <li class="children-item-list-text"><a href="/quoc-gia-du-hoc/du-hoc-ireland" class="children-item-list-text-link">Du học Ireland</a></li>
                                          <li class="children-item-list-text"><a href="{{route('getBlogByCategory',['id' => 21])}}" class="children-item-list-text-link">Hành trang du học</a></li>
                                          <li class="children-item-list-text"><a href="{{route('getBlogByCategory',['id' => 22])}}" class="children-item-list-text-link">Câu hỏi thường gặp</a></li>
                                          <li class="children-item-list-text"><a href="{{route('getBlogByCategory',['id' => 23])}}" class="children-item-list-text-link">Blog du học</a></li>
                                          <li class="children-item-list-text"><a href="/khao-sat" class="children-item-list-text-link">Khảo sát</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                  @endif
              </div>
          @endforeach
          @endif
      </div>
    </div>
  </div>
</nav>

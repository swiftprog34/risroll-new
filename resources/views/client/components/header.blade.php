<script src="/client/lib/jquery.maskedinput.min.js"></script>
<script>
    $(document).ready(function () {
        /*Активные кнопки верхнего бара*/
        var url = document.location.href;
        $.each($("nav a"), function () {
            if (this.href == url) {
                $(this).addClass('activeee');
            }
            ;
        });
        var url = document.location.href;
        $.each($("header a"), function () {
            if (this.href == url) {
                $(this).addClass('activeee');
            }
            ;
        });
        /**/

        /*Активные кнопки бокового меню*/
        var url = document.location.href;
        $.each($(".aside1 li a"), function () {
            if (this.href == url) {
                $(this).addClass('activeee');
            }
            ;
        });
        /**/

    });
</script>
<div class="main_top">

    <header>
        <div class="container">
            <div class="logo">
                <a class="" href="{{route('index', session('city'))}}" style="margin: 0;">
                    <img style="position: relative; left: -2px;" src="/client/images/logo_white.png" alt=""/>
                </a>
            </div>
            <div class="menu">
                <div class="first_row">
                    <span class="h3">RisRoll - доставка готовых блюд | Работаем c 11:00 до 23:00</span>
                    <form action="/" method="get">
                        <select id="city_chooser" name="locations">
                            @foreach($cities as $city)
                                <option value="{{$city->slug}}" @if($city->id === $cityWithNested->id) selected @endif>{{$city->city_name}}</option>
                            @endforeach
                        </select>
                    </form>

                    <form action="{{route('search', session('city'))}}" method="post" class="search">
                        @csrf
                        <input type="hidden" name="tmpl" value="">
                        <input type="text" name="tmpl" placeholder="Что будем искать?" required>
                        <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
                    </form>
                </div>
                <div class="second_row">
                    <a href="{{route('promotions', session('city'))}}">Акции</a>
                    <a href="{{route('contacts', session('city'))}}">Контакты</a>
                    <a href="{{route('delivery', session('city'))}}">Доставка</a>
                    <div class="top_bar">
                        <div class="item">
                            <i class="phone c1"></i>
                            <a rel="nofollow" style="    width: 120px;" href="tel:{{$cityWithNested->getPhoneNumberAttribute()}}">{{$cityWithNested->getPhoneNumberAttribute()}}</a>
                        </div>
{{--                        <form action="{{route('search', session('city'))}}" method="post" class="search">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="tmpl" value="">--}}
{{--                            <input type="text" name="tmpl" placeholder="Найти" required>--}}
{{--                            <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>--}}
{{--                        </form>--}}
                        <div class="item">
                            <i class="map c1"></i>
                            <span><strong>{{$cityWithNested->city_name}}. </strong><br> @foreach($cityWithNested->pickupPoints as $point)
                                    {{$point->name}}<br>
                                @endforeach</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="desktop">
        <div class="container">
            <div class="menu">
                @foreach($categoriesMainDesktop as $category)
                    <div class="menu_item">
                        <img class="preview" src={{$category->image == null ? "/client/images/noimg.png" : $category->image->path}}
                             alt="{{$category->title}}"/>
                        <a href="{{route('category', ['subdomain' => session('city'), 'slug' => $category->slug])}}">{{$category->title}}</a>
                    </div>
                @endforeach
                <div class="menu_item"><a href="#">Еще</a><img class="arrow"
                                                                         src="/client/images/icons/ic_menu_down_black.png"
                                                                         alt=""/>
                    <ul class="submenu h4">
                        @foreach($cityWithNested->categories as $category)
                            @if($loop->index > 8)
                                <li>
                                    <a href="{{route('category', ['subdomain' => session('city'), 'slug' => $category->slug])}}">{{$category->title}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <a rel="nofollow" class="basket"
               href="{{route('checkout', session('city'))}}">
                <span class="s_h2 basketPrice">{{$userCartSum}}₽</span>
                <div class="icon rounded basket-area"><img src="/client/images/icons/ic_basket-2_white.png" alt=""/>
                </div>
            </a>
        </div>
    </nav>
</div>
<!--Смена стиля при скролле-->
<script>
    var select = document.getElementById('city_chooser');
    select.onchange = function(){
        this.form.action = 'http://' + select.value + '.risroll.ru';
        this.form.submit();
    };

    $(window).scroll(function () {
        if (window.innerWidth >= 800) {
            var h = 144;
        } else {
            var h = 0;
        }

        if ($(this).scrollTop() > h) {
            $('nav.desktop').addClass("scrollTop");
        } else {
            $('nav.desktop').removeClass("scrollTop");
        }
    });
</script>
<!---->
<!-- Окно с разделами для мобильной версии -->
<div class="win win_hide" id="navmenu-page" style="display: none;">
    <div class="mobile-menu_wrapper">
        <div class="top">
            <a class="logo" href="{{route('index', session('city'))}}" style="display: none;">
                <img src="/client/images/logo_white.png" title="" alt=""/>
            </a>
            <span class="mobile-header-info">работаем c 11:00 до 23:00</span>
        </div>
        <br>
        <form action="{{route('search', session('city'))}}" method="post" class="search">
            @csrf
            <input type="hidden" name="tmpl" value="">
            <input type="text" name="tmpl" placeholder="Что будем искать?" required>
            <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
        </form>
    </div>
    <div class="body">

        <div class="nav_list">
            <a class="item r2" href="{{route('promotions', session('city'))}}">
                <i class="ic_win_stock black"></i>
                <span>Акции</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a class="item r2"
               href="{{route('contacts', session('city'))}}">
                <i class="ic_win_info black"></i>
                <span>Контакты</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a class="item r2"
               href="{{route('delivery', session('city'))}}">
                <i class="ic_win_info black"></i>
                <span>Доставка</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
        </div>
        <div class="win_categories_grid">
            @foreach($cityWithNested->categories as $category)
                <a class="item r3"
                   href="{{route('category', ['subdomain' => session('city'), 'slug' => $category->slug])}}">
                    <img class="photo" src={{$category->image == null ? "/client/images/noimg.png" : $category->image->path}}
                         alt="{{$category->title}}"/>
                    <span class="cat">{{$category->title}}</span>
                </a>
            @endforeach
        </div>
    </div>
    <div class="close_win">
        <img src="/client/images/icons/ic_close_white.png">
    </div>
</div>
<script>setTimeout(() => {
        document.querySelector('.win').style.display = 'block';
    }, 1000);</script>
<!-- -->
<!-- Верхний бар для мобильной версии -->
<nav class="mobile">
    <div class="container">
        @if((!request()->is('/')))
        <a class="icon back" href="{{route('index', session('city'))}}" onclick="">
            <img src="/client/images/icons/ic_back_black.png" alt=""/>
        </a>
        @else
        <div class="icon " style="display: flex !important" ></div>
        @endif
        <a class="icon close_page" href="{{route('index', session('city'))}}" onclick="">
            <img src="/client/images/icons/ic_close_page_black.png" alt=""/>
        </a>
        <div class="page_title">
            <div class="logo" style="text-align: center;margin-bottom: 1px;">
                <a class="" href="{{route('index', session('city'))}}" style="margin: 0;">
                    <img style="position: relative; width: 27%;" src="/client/images/logo_white.png"  alt=""/>
                </a>
            </div>
            <span class="mobile-header-info">работаем c 11:00 до 23:00</span>
        </div>
        <a class="icon open_mobile_search" id="open_mobile_search" href="javascript:void(0);" onclick="">
            <img src="/client/images/icons/ic_search_white.png" alt=""/>
        </a>
        <a class="icon close_mobile_search win_hide" id="close_mobile_search" href="javascript:void(0);" onclick="">
            <img src="/client/images/icons/ic_close_white.png" alt=""/>
        </a>
    </div>
    <form action="{{route('search', session('city'))}}" method="post" class="search win_hide mobile_search_form"
          id="mobile_search_form" >
        @csrf
        <input type="hidden" name="tmpl" value="">
        <input type="text" name="tmpl" placeholder="Что будем искать?" required>
        <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
    </form>
</nav>

<script>
    $('body').on('click', '.open_mobile_search', function () {
        $('#mobile_search_form').removeClass('win_hide');
        $('#close_mobile_search').removeClass('win_hide');
        $('#open_mobile_search').addClass('win_hide');
        $('#home-slider-categories-wrapper').addClass('home-slider-categories-wrapper-search');
    });
    $('body').on('click', '.close_mobile_search', function () {
        $('#mobile_search_form').addClass('win_hide');
        $('#close_mobile_search').addClass('win_hide');
        $('#open_mobile_search').removeClass('win_hide');
        $('#home-slider-categories-wrapper').removeClass('home-slider-categories-wrapper-search');
    });
</script>
<!-- -->
<!-- Bottom bar -->
<div class="bottom_bar">
    <div class="item " href="">
        <a class="icon profile" href="tel:{{$cityWithNested->getPhoneNumberAttribute()}}">
            <img src="/client/images/icons/ic_phone_black.png" alt=""/>
            <label>Позвонить</label>
        </a>
    </div>
    <div class="item" href="">
        <a href="javascript:void(0);" class="openFullPage" data-page="navmenu">
            <img src="/client/images/icons/ic_open_navmenu_white.png" alt=""/>
            <label>Меню</label>
        </a>
    </div>
    <div class="item basket" href="">
        <div><span class="basketPrice">{{$userCartSum}}₽</span></div>
        <a class="basket-area-mobile"
           href="{{route('checkout', session('city'))}}"
           onclick="(document.getElementById('page-preloader').style.display='flex')">
            <img src="/client/images/icons/ic_basket_black.png" alt=""/>
            <label>Корзина</label>
        </a>
    </div>
</div>

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
    <div class="top_bar">
        <form action="https://ris72.ru/search.php" method="get" class="search">
            <input type="hidden" name="tmpl" value="">
            <input type="text" name="s" placeholder="Найти" required>
            <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
        </form>
        <div class="item">
            <i class="phone c1"></i>
            <a rel="nofollow" href="tel:+7(345)2500765">500-765</a>
        </div>
        <div class="item">
            <i class="map c1"></i>
            <span>Тюмень, ул. Широтная, д.43/2

Тюмень, ул. Эрвье, д.10</span>
        </div>
        <!--<i class="time c1"></i>
        <span>09:00 - 22:00</span>
        <div style="display: block; width: 48px;"></div>-->
    </div>
    <header>
        <div class="container">
            <div class="logo">
                <a class="" href="{{route('index', session('city'))}}" style="margin: 0;">
                    <img style="position: relative; left: -2px;" src="/client/images/logo.png" alt=""/>
                </a>
            </div>
            <div class="menu">
                <div class="first_row">
                    <span class="h3">RisRoll - доставка готовых блюд!</span>
                </div>
                <div class="second_row">
                    <a href="akcii.html">Акции</a>
                    <a href="https://ris72.ru/%D0%A0%D1%94%D0%A0%D1%95%D0%A0%D0%85%D0%A1%E2%80%9A%D0%A0%C2%B0%D0%A0%D1%94%D0%A1%E2%80%9A%D0%A1%E2%80%B9">Контакты</a>
                    <a href="{{route('index', 'saratov')}}">Доставка
                        и Оплата</a>
                </div>
            </div>
        </div>
    </header>
    <nav class="desktop">
        <div class="container">
            <div class="menu">
                @foreach($categoriesMainDesktop as $category)
                    <div class="menu_item">
                        <img class="preview" src="/client/admin/images/categories/goods01.png@20230423141958"
                             alt="Холодные роллы"/>
                        <a href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}">{{$category->title}}</a>
                    </div>
                @endforeach
                <div class="menu_item"><a href="index.html#">Еще</a><img class="arrow"
                                                                         src="/client/images/icons/ic_menu_down_black.png"
                                                                         alt=""/>
                    <ul class="submenu h4">
                        @foreach($cityWithNested->categories as $category)
                            @if($loop->index > 8)
                                <li>
                                    <a href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}">{{$category->title}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <a rel="nofollow" class="basket"
               href="{{route('checkout')}}">
                <span class="s_h2 basketPrice">0₽</span>
                <div class="icon rounded basket-area"><img src="/client/images/icons/ic_basket-2_white.png" alt=""/>
                </div>
            </a>
        </div>
    </nav>
</div>
<!--Смена стиля при скролле-->
<script>
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
    <div class="body">
        <div class="top">
            <a class="logo" href="index.html" style="display: none;">
                <img src="/client/images/logo.png" title="" alt=""/>
            </a>
        </div>
        <br>
        <form action="https://ris72.ru/search.php" method="get" class="search">
            <input type="hidden" name="tmpl" value="">
            <input type="text" name="s" placeholder="Найти" required>
            <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
        </form>
        <div class="nav_list">
            <a class="item r2" href="akcii.html">
                <i class="ic_win_stock black"></i>
                <span>Акции</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a class="item r2"
               href="https://ris72.ru/%D0%A0%D1%94%D0%A0%D1%95%D0%A0%D0%85%D0%A1%E2%80%9A%D0%A0%C2%B0%D0%A0%D1%94%D0%A1%E2%80%9A%D0%A1%E2%80%B9">
                <i class="ic_win_info black"></i>
                <span>Контакты</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a class="item r2"
               href="{{route('index', 'saratov')}}">
                <i class="ic_win_info black"></i>
                <span>Доставка и Оплата</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
        </div>
        <div class="win_categories_grid">
            @foreach($cityWithNested->categories as $category)
                <a class="item r3"
                   href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}">
                    <img class="photo" src="/client/admin/images/categories/goods01.png@20230423141958"
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
        <a class="icon open_sidebar">
            <!--<img src="/client/images/icons/ic_open_sidebar_black.png" alt="" />-->
        </a>
        <a class="icon back" href="index.html" onclick="">
            <img src="/client/images/icons/ic_back_black.png" alt=""/>
        </a>
        <a class="icon close_page" href="index.html" onclick="">
            <img src="/client/images/icons/ic_close_page_black.png" alt=""/>
        </a>
        <div class="page_title">
            <h1>RisRoll (г. Тюмень)</h1>
        </div>
        <a class="icon write_comment" href="index.html#write_comment">
            <img src="/client/images/icons/ic_write_comment.png" alt=""/>
        </a>
        <!--
                    <a class="icon profile" href="user/login.php">
            <img src="/client/images/icons/ic_profile.png" alt="" />
        </a>
                    -->
        <!--<a rel="nofollow" class="basket" href="корзина">
            <span class="s_h2 basketPrice">0₽</span>
            <div class="icon rounded basket-area-mobile">
                <img src="/client/images/icons/ic_basket_white.png" alt="" />
            </div>
        </a>-->
    </div>
</nav>
<!-- -->
<!-- Bottom bar -->
<div class="bottom_bar">
    <div class="item " href="">
        <a class="icon profile" href="tel:+7(345)2500765">
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
        <div><span class="basketPrice">0₽</span></div>
        <a class="basket-area-mobile"
           href="{{route('checkout')}}"
           onclick="(document.getElementById('page-preloader').style.display='flex')">
            <img src="/client/images/icons/ic_basket_black.png" alt=""/>
            <label>Корзина</label>
        </a>
    </div>
</div>
<!-- -->
<!-- Боковая панель для мобильной версии -->
<div class="sidebar">
    <a class="logo" href="{{route('index')}}">
        <img src="/client/images/logo.png" title="" alt=""/>
    </a>
    <li style="display: flex; align-items: center;">
        <a style="width: 100%;" href="https://ris72.ru/user/login.php">Мои бонусы</a>
        <a style="float: right; background: #c20609; border-radius: 1200px; padding: 2px 12px; font-size: 16px; color: #fff !important; text-align: center;"
           href="https://ris72.ru/user/login.php">Войти</a>
    </li>
    <a href="index.html">Акции</a>
    <a href="index.html">Контакты</a>
    <a href="{{route('index', 'saratov')}}">Доставка и Оплата</a>
    <label>Наше меню:</label>
    <div class="menu_items">
        @foreach($cityWithNested->categories as $category)
            <a href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}">
                <img src="/client/admin/images/categories/goods01.png@20230423141958" width="40px"
                     alt="{{$category->title}}"/>
                {{ $category->title }} </a>
        @endforeach
    </div>
    <br>
    <label>Свяжитесь с нами</label>
    <a rel="nofollow" href="tel:+7(345)2500765"><i class="phone black"></i>Позвонить</a>
</div>
<!--<script src="/client/lib/sidebar.js"></script>-->
<!-- -->

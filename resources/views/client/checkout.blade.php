@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <div class="breadcrumbs container" itemscope itemtype="http://schema.org/BreadcrumbList">
        <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
            <a itemprop="item" title="Главная" href="{{route('index', session('city'))}}">
                <span itemprop="name">Главная</span>
                <meta itemprop="position" content="1">
            </a>
        </span>
        ->
        <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
            <a itemprop="item" title="" href="{{route('checkout', session('city'))}}">
                <span itemprop="name">Корзина</span>
                <meta itemprop="position" content="2">
            </a>
        </span>
    </div>
    <input type="hidden" id="total" value="{{$userCartSum}}">
    <!-- Updated 10.12.2022 - start -->
    <input type="hidden" id="dtotal" value="{{$userCartSum}}">
    <!-- Updated 10.12.2022 - end -->
    <!--Если в корзине нет товаров-->
    @if($userCart->products->count() <= 0 )
    <div class="emptyCart">
        <img src="/client/images/no_cart.png">
        <span>Корзина пуста!</span>
    </div>
    @else
    <!---->
        <x-form action="{{ route('public.order.create', session('city')) }}" method="post">
    <div class="cart ">
        <input type="hidden" id="bonusBal" value="0">
        <input type="hidden" id="bonusCost" name="bonus" value="0">
        <input type="hidden" id="deliveryCost" value="0">
        <!-- Updated 08.03.2023 - start -->
        <input type="hidden" id="deliveryCost2" value="0">
        <!-- Updated 08.03.2023 - end -->
        <input type="hidden" id="deliveryFree" value="700">
        <input type="hidden" id="deliveryMin" value="700">
        <input type="hidden" id="couponDiscount" value="1">
        <input type="hidden" id="couponType" value="percent">
        <!-- Предзаказ -->
        <input type="hidden" id="dTimeFrom" value="9:00">
        <input type="hidden" id="dTimeTo" value="22:00">
        <input type="hidden" id="dTimeMin" value="2023-09-29T15:16:10+03:00">
        <!-- End -->
        <div class="container">
            <a class="back_menu" href="" onclick="">
                <i class="ic_back"></i>
                <span>Вернуться назад</span>
            </a>
            <!--WorkTime-->
            <!---->
            <!--Бонусы--
                        <div class="notUser">
                <div>
                    <h2 class="s_h2">Хотите получить бонусы за этот заказ?</h2>
                    <p class="s_h3">Зарегистрируйтесь в нашей бонусной системе прямо сейчас!</p>
                </div>
                <a class="button" href="user/login.php">Хочу получать бонусы!</a>
            </div>
            <br>
                     -->
        </div>
        <!-- Слайдер с подарками -->
        <link rel="stylesheet" href="/client/lib/carousel/carousel.css"/>
        <script src="/client/lib/carousel/owl.carousel_v2.min.js"></script>
        <div id="giftsList">
            <div class="container" style="margin-top: 0; margin-bottom: 0;">
                <h2>Выберите подарок:</h2>
            </div>
            <div class="slider_scale_items owl-carousel owl-theme">
            </div>
        </div>
        <script>
            $(document).ready(function () {

                var $owl = $(".slider_scale_items").owlCarousel({
                    margin: 40,
                    smartSpeed: 400,
                    navSpeed: 400,
                    navText: ['<span class="arrow-prev"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>', '<span class="arrow-next"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path> </svg></span>'],

                    dots: false,
                    nav: true,
                    checkVisible: false,
                    responsive: {
                        0: {
                            center: true,
                            items: 2.0,
                            stagePadding: 0,
                            margin: 16,
                            loop: false,
                            nav: false,
                            autoplay: false,
                        },
                        767: {
                            center: false,
                            items: 3,
                            stagePadding: 120,
                            loop: false,
                            autoplay: false,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,
                        },
                        1600: {
                            items: 3,
                            stagePadding: 155,
                        },
                        1800: {
                            stagePadding: 290,
                            items: 3,
                        }
                    }
                });
                $('#giftsList').addClass('hide');

            });
        </script>
        <!---->
        <div class="container custom-cart-container">
            <h2>Вы добавили</h2>
            <div class="cart_block">
                <div class="every" id="cart-list">
                    @foreach($userCart->products as $cartProduct)
                        <div class="cart_item">
                            <div class="image">
                                <!--<img class="lazyImg" src="images/noimg.png" data-original="https://ris72.ru/admin/images/maxi/goods10/1703383466444ed443b0209.87271863.jpg">-->
                                <img class="" src="{{$cartProduct->image == null ? "/client/images/noimg.png" : $cartProduct->image->path}}">
                            </div>
                            <div class="product">
                                <p class="cat">{{$cartProduct->category->title}}</p>
                                <h3 class="title">{{$cartProduct->title}}</h3>
                            </div>
                            <div class="button">
                                <div class="updateCart minus" data-id="{{$cartProduct->id}}"
                                     data-cid="{{$cartProduct->id}}" data-type="-1"><span>-</span></div>
                                <div class="kolvo"><span>{{$cartProduct->pivot->quantity}}</span></div>
                                <div class="updateCart plus" data-id="{{$cartProduct->id}}"
                                     data-cid="{{$cartProduct->id}}" data-type="+1"><span>+</span></div>
                            </div>
                            <div class="calc">
                                <p class="formula"><span>{{$cartProduct->pivot->quantity}}</span>
                                    х {{$cartProduct->price}}₽</p>
                                <h3 class="result">{{$cartProduct->pivot->quantity * $cartProduct->pivot->price}}₽</h3>
                            </div>
                            <div class="clear">
                                <a href="javascript:void(0);" class="removeCart" data-cid="{{$cartProduct->id}}"
                                   data-id="{{$cartProduct->id}}">
                                    <img src="/client/images/icons/ic_clear.png" width="32px">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="lastline">
                    <a href="javascript:void(0);" class="md-trigger" data-modal="modal-0">Очистить корзину</a>
                    <p class="orderCost">Сумма заказа: <span>{{$userCartSum}}</span>₽</p>
                </div>
            </div>
        </div>
        <div class="container">
            <h2>Количество персон</h2>
            <div class="block">
                <div class="number">
                    <button class="number-minus" type="button"
                            onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">-
                    </button>
                    <input type="number" name="persons" min="1" value="1" max="10" readonly>
                    <button class="number-plus" type="button"
                            onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">+
                    </button>
                </div>
            </div>
            <h2 id="deliveryMethod">Способ получения заказа</h2>
            <div class="block">
                <input id="r1" type="radio" name="receiving_type" value="delivery" aria-required="true" onChange="Selected(this)"
                       checked>
                <label for="r1">Доставка</label>
                <div id='block1'>
                    <h3>Выберите район доставки</h3>
                    <select name="locations">
                        <option value="3">Тюмень</option>
                    </select>
                    <span class="deliveryCost">
						+ 0₽
					</span>
                    <p class="">
                        Бесплатная доставка от <span id="delFree">700</span>₽<br>
                        Минимальная сумма заказа <span id="delMin">700</span><br>
                        <span id="delInfo">В отдаленные районы минимальная сумма заказа 1300р (подробности уточняйте у администратора)</span>
                    </p>
                    <h3>Укажите адрес доставки</h3>
                    <div class="address_fields">
                        <div>
                            <div class="field">
                                <label>Улица</label>
                                <input type="text" name="street" placeholder="*Улица">
                            </div>
                            <div class="field">
                                <label>Дом</label>
                                <input type="text" name="home" placeholder="*Дом">
                            </div>
                        </div>
                        <div>
                            <div class="field">
                                <label>Квартира</label>
                                <input type="tel" name="apart" placeholder="Квартира">
                            </div>
                            <div class="field">
                                <label>Подъезд</label>
                                <input type="tel" name="entrance" placeholder="Подъезд">
                            </div>
                            <div class="field">
                                <label>Этаж</label>
                                <input type="tel" name="floor" placeholder="Этаж">
                            </div>
                        </div>
                        <div class="text-error"></div>
                    </div>
                </div>
                <div class="indent"></div>
                <input id="r2" type="radio" name="receiving_type" value="pickup" aria-required="true" onChange="Selected(this)">
                <label for="r2">Самовывоз </label>
                <div id='block2' style='display: none;'>
                    <h3>Выберите адрес самовывоза</h3>
                    <select id="pickup-points" name="points">
                        <!--<option value="" data-discount="0" data-content="">Не выбран</option>-->
                        @foreach($cityWithNested->pickupPoints as $pickup)
                        <option
                            data-content=""
                            value="{{$pickup->id}}" data-discount="0">
                            {{$cityWithNested->city_name}}, {{$pickup->name}}
                        </option>
                        @endforeach
                    </select>
                    <div id="pickup-content">
                    </div>
                </div>
                <script>
                    function Selected(a) {
                        var label = a.value;
                        if (label == "delivery") {
                            document.getElementById("block1").style.display = 'block';
                        } else {
                            document.getElementById("block1").style.display = 'none';
                        }
                        if (label == "pickup") {
                            document.getElementById("block2").style.display = 'block';
                        } else {
                            document.getElementById("block2").style.display = 'none';
                        }
                        $("html, body").animate({scrollTop: $('#deliveryMethod').offset().top + "px"});
                    }
                </script>
            </div>
            <h2>Время получения заказа</h2>
            <div class="block">
                <input id="t1" type="radio" name="datetime" value="fast" aria-required="true" onChange="Selected2(this)"
                       checked="">
                <label for="t1">Как можно скорей</label>
                <div class="indent"></div>
                <input id="t2" type="radio" name="datetime" value="bytime" onChange="Selected2(this)"
                       aria-required="true">
                <label for="t2">Ко времени</label>
                <div id='block_time' style="display: none;">
                    <h3>Выберите дату и время доставки</h3>
                    <div class="address_input">
                        <div class="first">
                            <input type="text" id="dtDate" name="odated" value="29.09.2023" placeholder=""
                                   style="width: 25%;" readonly>
                            <select id="dtTime" name="otimed">
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00" selected>15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                                <option value="23:00">23:00</option>
                            </select>
                        </div>
                        <div class="text-error"></div>
                    </div>
                    <!--
                    <div class="textInfo warn">
                        * Доставка будет осуществлена <span id="deliveryTimeInfo">29.09.2023 с 9:00 до 10:00</span>
                    </div>
                    -->
                </div>
                <script>
                    function Selected2(a) {
                        var label = a.value;
                        if (label == "bytime") {
                            document.getElementById("block_time").style.display = 'block';
                        } else {
                            document.getElementById("block_time").style.display = 'none';
                        }
                    }
                </script>
            </div>
            <h2>Способ оплаты</h2>
            <div class="block">
                <input id="p1" type="radio" name="pay" value="cash" aria-required="true" checked="">
                <label for="p1">Наличными</label>
                <div class="indent"></div>
                <input id="p2" type="radio" name="pay" value="card" aria-required="true">
                <label for="p2">Банковской картой</label>
                <!--<div class="indent"></div>
                <input id="p3" type="radio" name="pay" value="online" aria-required="true">
                <label for="p3">Онлайн оплата</label>-->
            </div>
            <h2>Контактная информация</h2>
            <div class="block">
                <div class="contact_fields">
                    <div class="field">
                        <label>Имя</label>
                        <input type="text" name="uname" placeholder="Имя" value="">
                        <div class="text-error"></div>
                    </div>
                    <div class="field">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="phone_mask" placeholder="Телефон" value=""
                               autocomplete="off">
                        <script>$(".phone_mask").mask("8(999)999-99-99");</script>
                        <div class="text-error"></div>
                    </div>
                    <div class="field">
                        <label>Комментарий</label>
                        <textarea name="comment" placeholder="Ваш комментарий к заказу"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" id="bonusMax" value="0">
            <input type="hidden" id="bonusMaxPrc" value="50">
            <div class="block itog">
                <div>
                    <p class="orderCost2">Сумма заказа: <span>{{$userCartSum}}</span>₽</p>
                    <p>
                        Стоимость доставки: <span class="deliveryCostBtm">0₽</span>
                    </p>
                    <!-- Updated 10.12.2022 - start -->
                    <p class="promoCost hide">Промокод: <span>0₽</span></p>
                    <!-- Updated 10.12.2022 - end -->
                </div>
                @if($cityWithNested->can_make_orders == 1)
                <div>
                    <button class="order">
                        <div class="buttonText">Заказать: <span>{{$userCartSum}}</span> ₽</div>
                        <img class="loaderCartImg hide" src="/client/images/load_spinner_white.gif">
                    </button>
                </div>
                @else
                <div>
                    <div class="order-disabled">
                        <div class="buttonText">Заказ не возможен по техническим причинам</div>
                        <img class="loaderCartImg hide" src="/client/images/load_spinner_white.gif">
                    </div>
                </div>
                @endif
                <div id="cartMsg" class="text-error"></div>
            </div>
        </div>
    </div>
        </x-form>
    @endif
</div>
@if($cityWithNested->can_make_orders == 0)
    <div id="cant_make_orders_notification">
        <p>В данный момент, по техническим причинам, заказы оформлять нельзя :-(.</p>
        <button class="button cant_make_orders_accept">Понятно</button>
    </div>
@endif
@if($cityWithNested->can_make_orders == 1 && !$can_receive_orders)
    <div id="cant_receive_orders_notification">
        <p>Принимаем заказы<br>с {{$cityWithNested->time_from}}<br>до {{$cityWithNested->time_till}}.</p>
        <button class="button cant_receive_orders_accept">Хочу оформить предзаказ</button>
    </div>
@endif
<script>
    @if($cityWithNested->can_make_orders == 0)
    function checkCookiesCantMakeOrder() {
        let cookieCant_make_ordersDate = localStorage.getItem('cookieCant_make_ordersDate');
        let cookieNotification = document.getElementById('cant_make_orders_notification');
        let cookieBtn = cookieNotification.querySelector('.cant_make_orders_accept');

        // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
        if (!cookieCant_make_ordersDate || (+cookieCant_make_ordersDate + 8640000) < Date.now()) {
            cookieNotification.classList.add('show');
        }

        // При клике на кнопку, в локальное хранилище записывается текущая дата в системе UNIX
        cookieBtn.addEventListener('click', function () {
            localStorage.setItem('cookieCant_make_ordersDate', Date.now());
            cookieNotification.classList.remove('show');
        })
    }

    checkCookiesCantMakeOrder()
    @endif

    @if($cityWithNested->can_make_orders == 1 && !$can_receive_orders)
    function checkCookiesCantReceiveOrder() {
        let cookieCant_receive_ordersDate = localStorage.getItem('cookieCant_receive_ordersDate');
        let cookieNotification = document.getElementById('cant_receive_orders_notification');
        let cookieBtn = cookieNotification.querySelector('.cant_receive_orders_accept');

        // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
        if (!cookieCant_receive_ordersDate || (+cookieCant_receive_ordersDate + 8640000) < Date.now()) {
            cookieNotification.classList.add('show');
        }

        // При клике на кнопку, в локальное хранилище записывается текущая дата в системе UNIX
        cookieBtn.addEventListener('click', function () {
            localStorage.setItem('cookieCant_receive_ordersDate', Date.now());
            cookieNotification.classList.remove('show');
        })
    }

    checkCookiesCantReceiveOrder()
    @endif

    var dates = [new Date("2020-12-25"), new Date("2020-12-31"), new Date("2020-12-26"), new Date("2021-01-01"), new Date("2021-01-02"), new Date("2021-01-03"), new Date("2020-12-29"), new Date("2020-12-30"), new Date("2021-03-05"), new Date("2021-03-04"), new Date("2021-05-22"),];

    function offDays(date) {
        for (var i = 0; i < dates.length; i++) {
            if (date.getDate() == dates[i].getDate() & date.getMonth() == dates[i].getMonth() & date.getYear() == dates[i].getYear()) {
                return [false];
            }
        }

        return [true];
    }

    $('#dtDate').datepicker({
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        firstDay: 1,
        dateFormat: "dd.mm.yy",
        beforeShowDay: offDays,
        minDate: new Date(2023, 8, 29),
        maxDate: new Date(2023, 9, 13)
    });
</script>
<!-- -->
<link rel="stylesheet" type="text/css" href="/client/lib/md-modal/component.css"/>
<script src="/client/lib/md-modal/modernizr.custom.js" async></script>
<!-- Очистка корзины -->
<div class="md-modal md-effect-2" id="modal-0">
    <div class="md-content">
        <h4>Вы уверены, что хотите удалить товары из корзины?</h4>
        <br>
        <div>
            <input type="submit" class="close" value="НЕТ">
            <input type="submit" class="btn_ok cleanCartBtn" value="ДА">
        </div>
    </div>
</div>
<!-- -->
<!-- Количество бонусов для списания -->
<div class="md-modal md-effect-2" id="modal-1">
    <div class="md-content">
        <h4>Укажите количество</h4>
        <input type="number" id="myBonuses" value="0">
        <p class="error-text"></p>
        <br>
        <div>
            <input type="submit" class="close" value="ОТМЕНА">
            <input type="submit" class="btn_ok" value="ОК">
        </div>
    </div>
</div>
<div class="md-overlay"></div>
<!-- classie.js by @desandro: https://github.com/desandro/classie -->
<script src="/client/lib/md-modal/classie.js" async></script>
<script src="/client/lib/md-modal/modalEffects.js" async></script>
@include('client.components.totop')
@include('client.components.close_win')
@include('client.components.cookies_check')
@include('client.components.cart')
</body>
</html>

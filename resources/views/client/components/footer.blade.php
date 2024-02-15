<footer>
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



    <div class="container">
        <img class="logo_footer" src="/client/images/logo_white.png" title="" alt=""/>
        <div class="social">
            <a rel="nofollow" href="{{$cityWithNested->vk_link}}" target="_blank"><i class="vk"></i></a>
            <a rel="nofollow" href="{{$cityWithNested->instagram_link}}" target="_blank"><i class="instagram"></i></a>
        </div>
        <ul class="f_cats">
            @foreach($cityWithNested->categories as $category)
                <li>
                    <a href="{{route('category', ['subdomain' => session('city'), 'slug' => $category->slug])}}">{{$category->title}}</a>
                </li>
            @endforeach
        </ul>
        <ul class="f_info">
            <li>Ресторан доставки еды</li>
            <li>{{$cityWithNested->city_name}}, @foreach($cityWithNested->pickupPoints as $point)
                    {{$point->name}}
                @endforeach
            </li>
            <li><a rel="nofollow" href="tel:{{$cityWithNested->getPhoneNumberAttribute()}}">{{$cityWithNested->getPhoneNumberAttribute()}}</a></li>
        </ul>
        <div class="lastline">
            <p class="">Copyright © {{date("Y")}} RisRoll. Все права защищены!</p>
            <a rel="nofollow" href="{{route('terms', session('city'))}}">Пользовательское соглашение</a>
            <a rel="nofollow" href="{{route('privacy', session('city'))}}">Политика конфиденциальности</a>
        </div>
    </div>
    <div class="bg0"></div>
    <div class="splash"></div>
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

        </script>
</footer>

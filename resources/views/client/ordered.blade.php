@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main class="container animated fadeIn">

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

        <div class="" style="text-align: center;margin-top: 5em;">
            <h2>Спасибо за заказ!</h2>
            <h3>Наш оператор свяжется с вами в ближайшее время.</h3>
            <h3 style="margin-top: 1em;">Если вам не поступит обратный звонок от оператора в течении 10 минут, пожалуйста, свяжитесь с нами по телефону 8(961)083-22-33 для подтверждения заказа</h3>
        </div>
        <div style="text-align: center;margin-top: 3em;">
            <a class="order" href="{{route('index', session('city'))}}">
                <div class="buttonText">Вернуться на главную страницу</div>
            </a>
        </div>
    </main>
    @include('client.components.footer')
</div>
<script src="/client/lib/animate_add.js" async></script>
<!---->
@include('client.components.totop')
<!--end-->
@include('client.components.close_win')
@include('client.components.cookies_check')
</body>
</html>
@include('client.components.readmore')

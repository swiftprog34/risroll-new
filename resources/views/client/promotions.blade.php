@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main class="animated fadeIn container">
        <!-- Хлебные крошки -->
        <div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="Главная" href="{{route('index', session('city'))}}">
                    <span itemprop="name">Главная</span>
                    <meta itemprop="position" content="1">
                </a>
            </span>
            ->
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="Акции" href="{{route('promotions', session('city'))}}">
                    <span itemprop="name">Акции</span>
                    <meta itemprop="position" content="2">
                </a>
            </span>
        </div>

        <div class="title_filters_grid">
            <h1 class="cat_name">Акции</h1>
        </div>
        <div class="page_text">
            {!! $cityWithNested->promotions_page_info !!}
        </div>
        <section class="stock">
            <div class="stock-grid">
                @foreach($cityWithNested->promotions as $promotion)
                <div class="stock-item">
                    <div class="image">
                        <img class="lazyImg" src="/client/images/noimg.png"
                             data-original="{{$promotion->image}}">
                        <noscript><img
                                src="{{$promotion->image}}">
                        </noscript>
                    </div>
                    <div class="text">
                        <h3 class="title">{{$promotion->name}}</h3>
                        <p class="desc">
                            {!!  $promotion->description !!}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

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
<!---->

@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main class="container animated fadeIn">
        <div class="">
            <div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
	                <a itemprop="item" title="Главная" href="{{route('index', session('city'))}}">
	                    <span itemprop="name">Главная</span>
	                    <meta itemprop="position" content="1">
	                </a>
	            </span>
                ->
                <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
	                <a itemprop="item" title="" href="{{route('delivery', session('city'))}}">
	                    <span itemprop="name">Доставка и оплата</span>
	                    <meta itemprop="position" content="2">
	                </a>
	            </span>
            </div>
        </div>
        <div class="page_text">
            <h1>Доставка и оплата</h1>
            {!! $cityWithNested->delivery_page_info !!}
        </div>
        <div class="container">
            <div class="text_block2">
                {!! $cityWithNested->delivery_map !!}
            </div>
        </div>
    </main>
    @include('client.components.footer')
    <script src="/client/lib/animate_add.js" async></script>
    @include('client.components.totop')
@include('client.components.close_win')
@include('client.components.cookies_check')
@include('client.components.cart')
</body>
</html>
@include('client.components.readmore')

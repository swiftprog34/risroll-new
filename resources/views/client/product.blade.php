@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main class="animated fadeIn container">
        <div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="Главная" href="{{route('index', session('city'))}}">
                    <span itemprop="name">Главная</span>
                    <meta itemprop="position" content="1">
                </a>
            </span>
            ->
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="{{$product->category->title}}"
                   href="{{route('category', ['city' => session('city'), 'id' => $product->category->uid])}}">
                    <span itemprop="name">{{$product->category->title}}</span>
                    <meta itemprop="position" content="2">
                </a>
            </span>
            ->
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="{{$product->title}}"
                   href="{{route('product', ['city' => session('city'), 'id' =>  $product->uid])}}">
                    <span itemprop="name">{{$product->title}}</span>
                    <meta itemprop="position" content="3">
                </a>
            </span>
        </div>
        <a class="back_menu" href="{{route('index', session('city'))}}history.back();return&#32;false;"
           onclick="history.back();return false;">
            <i class="ic_back"></i>
            <span>Вернуться назад</span>
        </a>
        <section class="product" id="item-{{$product->id}}">
            <div class="product-item ani">
                <div class="item_photo ">
                    <img class="photo" src="{{$product->image}}"
                         title="{{$product->title}}" alt="{{$product->title}}"/>
                </div>
                <div class="information">
                    <div class="product_row item_title">
                        <h1 class="title h1 s_h1">{{$product->title}}</h1>
                    </div>
                    <div class="item_cost">
                        <h2 class="cost h1 s_h1">{{$product->price}}₽</h2>
                    </div>
                    <div class="product_row item_desc">
                        <p class="s_h3">{{$product->description}}<br></p>
                    </div>
                    <div class="product_row item_weight">
                        <span>xxxxx8шт.   Вес: xxxxxx320г.</span>
                        <input type='hidden' id='price-{{$product->id}}' value='{{$product->price}}'
                               data-external_id=''>
                    </div>
                    <div class="item_button">
                        <div class="button-passive ">
                            <div class="addToCart" data-id="{{$product->id}}">Добавить</div>
                        </div>
                        <div class="button-active hide">
                            <div class="updateCart minus animinus" data-cid="0" data-type="-"><span>-</span></div>
                            <div class="kolvo"><span>0</span></div>
                            <div class="updateCart plus aniplus" data-cid="0" data-type="+"><span>+</span></div>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
            <span itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="{{$product->title}}">
    <meta itemprop="description" content="{{$product->description}}<br> ">
    <link itemprop="image" href="{{$product->image}}"/>
    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="price" content="{{$product->price}}">
        <meta itemprop="priceCurrency" content="RUB">
    </span>
</span></section>
    </main>
</div>
<script src="/client/lib/animate_add.js" async></script>
@include('client.components.totop')
<!--end-->
@include('client.components.close_win')
@include('client.components.cookies_check')
<script>
    $(document).ready(function () {
        let hash_product = window.location.hash.split('#');
        if (hash_product[1] !== '') {
            $('.item_weight select option[data-external_id=\'' + hash_product[1] + '\']').prop('selected', 'selected').trigger('change');
        } else {
            $('.item_weight select option').eq(0).prop('selected', 'selected').trigger('change');
        }
    });
</script>
</body>
</html>




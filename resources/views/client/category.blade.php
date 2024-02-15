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
                <a itemprop="item" title="{{$currentCategory->title}}"
                   href="{{route('category', ['subdomain' => session('city'), 'slug' => $currentCategory->slug])}}">
                    <span itemprop="name">{{$currentCategory->title}}</span>
                    <meta itemprop="position" content="2">
                </a>
            </span>
        </div>
        <div class="title_filters_grid">
            <h1 class="cat_name">{{$cityWithNested->city_name}} - Заказать {{mb_strtolower($currentCategory->title,'UTF-8')}} недорого</h1>
            <div class="filters">
                <div class="filter_off" id="delItemsFilters">
                    <img src="/client/images/icons/ic_clear_filters.png">
                </div>
                <div class="tags" id="itemFilterPrice">
                    <div class="tags_item" data-sort="asc">Цена <i class="arrow ic_arrow_up"></i>
                        <!--<span class="hide">x</span>--></div>
                    <div class="tags_item" data-sort="desc">Цена <i class="arrow ic_arrow_down"></i>
                        <!--<span class="hide">x</span>--></div>
                </div>
            </div>
        </div>
        <div class="text_block">
            {!!  $currentCategory->description !!}
        </div>
        <section class="products">
            <div class="products-grid st_grid">
                @foreach($currentCategory->products as $product)
                    <div class="product-item ani st_item" id="item-{{$product->id}}" data-price="{{$product->price}}"
                         data-tags="" data-pos="{{$loop->index}}">
                        <div class="image cover">
                            <a href="{{route('product', ['subdomain' => session('city'), 'slug' => $product->slug])}}">
                                <img class="lazyImg"
                                     src={{$product->image == null ? "/client/images/noimg.png" : $product->image->path}}
                                     data-original="{{$product->image}}"
                                     title="" alt=""/>
                                <noscript><img src="{{$product->image}}"
                                               alt=""/></noscript>
                            </a>
                        </div>
                        <div class="text">
                            <a href="{{route('product', ['subdomain' => session('city'), 'slug' => $product->slug])}}">
                                <h3 class="title" title="{{$product->title}}">{{$product->title}}</h3>
                                <p class="desc" title="{{$product->description}}">{{$product->description}}</p>
                            </a>
                            <div class="weight">
                                <span class="s_h3">Вес: 250г.</span>
                                <input type='hidden' id='price-{{$product->id}}' value='{{$product->price}}'
                                       data-external_id='{{$product->uid}}'>
                            </div>
                            <div class="cost-line">
                                <p class="cost">
                                    {{$product->price}}₽
                                </p>
                                @if($userCart != null)
                                    @if($userCart->products->contains('id', $product->id))
                                        @foreach($userCart->products as $cartProduct)
                                            @if($cartProduct->id == $product->id)
                                                <div class="button-passive hide">
                                                    <div class="s_h3 addToCart" data-id="{{$product->id}}">В корзину
                                                    </div>
                                                </div>
                                                <div class="button-active ">
                                                    <div class="updateCart minus animinus" data-id="{{$product->id}}"
                                                         data-cid="{{$userCart->session_id}}" data-type="-1">
                                                        <span>-</span>
                                                    </div>
                                                    <div class="kolvo"><span>{{$cartProduct->pivot->quantity}}</span>
                                                    </div>
                                                    <div class="updateCart plus aniplus" data-id="{{$product->id}}"
                                                         data-cid="{{$userCart->session_id}}" data-type="+1">
                                                        <span>+</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="button-passive ">
                                            <div class="s_h3 addToCart" data-id="{{$product->id}}">В корзину</div>
                                        </div>
                                        <div class="button-active hide">
                                            <div class="updateCart minus animinus"  data-id="{{$product->id}}" data-cid="0" data-type="-1">
                                                <span>-</span>
                                            </div>
                                            <div class="kolvo"><span>0</span></div>
                                            <div class="updateCart plus aniplus"  data-id="{{$product->id}}" data-cid="0" data-type="+1">
                                                <span>+</span>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="button-passive ">
                                        <div class="s_h3 addToCart" data-id="{{$product->id}}">В корзину</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <span itemscope itemtype="http://schema.org/ImageGallery">
	        @foreach($currentCategory->products as $product)
                    <span itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <meta itemprop="name" content="{{$product->title}}"/>
                <meta itemprop="description" content="{{$product->title}}"/>
                <link itemprop="thumbnailUrl" href="{{$product->image}}"/>
                <link itemprop="contentUrl" href="{{$product->image}}"/>
                <meta itemprop="author" content=""/>
                <meta itemprop="datePublished" content="{{$product->created_at}}">
            </span>
                @endforeach

            </span>
        </section>
        <div class="text_block2">
            {!! $currentCategory->bottom_description !!}
        </div>
    </main>
    <div class="slider03">
        <h2 class="container" style="margin: 0;">Другие категории</h2>
        <link rel="stylesheet" href="/client/lib/carousel/carousel.css"/>
        <script src="/client/lib/carousel/owl.carousel_v2.min.js"></script>
        <div class="home-slider3 owl-carousel owl-theme ">
            @foreach($cityWithNested->categories as $category)
                <a class="slider_item "
                   href="{{route('category', ['subdomain' => session('city'), 'slug' => $category->slug])}}">
                    <img src="{{$category->image == null ? "/client/images/noimg.png" : $category->image->path}}"
                         alt="{{$category->title}}"
                         title="{{$category->title}}"/>
                    <span class="cat">{{$category->title}}</span>
                </a>
            @endforeach
        </div>
        <script>
            $(document).ready(function () {
                $(".home-slider3").owlCarousel({
                    margin: 60,
                    smartSpeed: 400,
                    navSpeed: 400,

                    navText: ['<span class="arrow-prev"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>', '<span class="arrow-next"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path> </svg></span>'],

                    dots: false,
                    nav: false,

                    responsive: {

                        0: {
                            center: false,
                            items: 3,
                            stagePadding: 16,
                            margin: 16,
                            loop: false,
                            nav: false,
                            autoplay: false,
                        }
                    }
                });
            });
        </script>
    </div>
    @include('client.components.footer')
</div>
<script src="/client/lib/tooltip.js"></script>
<script src="/client/lib/animate_add.js" async></script>
@include('client.components.readmore')
<div class="md-overlay"></div>
<script src="/client/lib/md-modal/classie.js" async></script>
<script src="/client/lib/md-modal/modalEffects.js" async></script>
@include('client.components.totop')
@include('client.components.close_win')
@include('client.components.cookies_check')
@include('client.components.cart')
</body>
</html>




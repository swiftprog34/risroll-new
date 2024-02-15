@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main>
        <div class="slider03 home-slider-categories-wrapper" id="home-slider-categories-wrapper">
            <div class="home-slider-categories owl-carousel owl-theme ">
                @foreach($cityWithNested->categories as $category)
                    <div class=""><a href="#category-{{$category->id}}" class="slider-categories-item">{{$category->title}}</a></h4></div>
                @endforeach
            </div>
        </div>
        <div class="delivery_info_grid">
            <a rel="nofollow" class="item"
               href="{{$cityWithNested->gis_link}}">
                <img src="/client/images/color_icons/ic_map.png">
                <span>
                    <strong>{{$cityWithNested->city_name}}</strong><br>
                    @foreach($cityWithNested->pickupPoints as $point)
                        {{$point->name}}<br>
                    @endforeach</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a rel="nofollow" class="item" href="tel:{{$cityWithNested->getPhoneNumberAttribute()}}">
                <img src="/client/images/color_icons/ic_phone.png">
                <span>{{$cityWithNested->getPhoneNumberAttribute()}}</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
        </div>
        @if($cityWithNested->promotions->count() > 0)
        <div class="slider02">
            <div class="home-slider owl-carousel owl-theme ">
                @foreach($cityWithNested->promotions as $promotion)
                    @if($promotion->link !== null)
                        <a href="{!! $promotion->link !!}" target="_blank">
                    @endif
                    @if($promotion->image !== null)
                        <div class="home-slider__item">
                            <img
                                src="{{$promotion->image == null ? "/client/images/noimg.png" : $promotion->image->path}}"
                                alt="{{$promotion->name}}" title="{{$promotion->name}}"/>
                        </div>
                    @endif
                    @if($promotion->link !== null)
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="/client/lib/carousel/carousel.css"/>
        <script src="/client/lib/carousel/owl.carousel_v2.min.js"></script>
        <script>

            const smoothLinks = document.querySelectorAll('a[href^="#"]');
            for (let smoothLink of smoothLinks) {
                smoothLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = smoothLink.getAttribute('href');

                    document.querySelector(id).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

            $(document).ready(function () {

                $(".home-slider").owlCarousel({

                    margin: 40,
                    smartSpeed: 400,
                    navSpeed: 400,
                    dots:false,
                    navText: ['<span class="arrow-prev"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>', '<span class="arrow-next"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path> </svg></span>'],

                    responsive: {
                        1480: {
                            center: true,
                            items: 1.47,
                            loop: true,
                            nav: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,
                            dots:false,

                        },
                        767: {
                            center: true,
                            items: 1.3,
                            loop: true,
                            nav: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,
                            dots:false,

                        },
                        0: {
                            center: true,
                            items: 1,
                            loop: false,
                            nav: false,
                            autoplay: true,
                            dots:false,
                        }
                    }
                });
            });
        </script>
        @endif
        <div class="container">
            <div class="heading mobile-none000">
                <div class="line"><img src="/client/images/de-line-1.png" alt=""/></div>
                <h1>RisRoll - {{$cityWithNested->city_name}}. Доставка готовых блюд!</h1>
                <div class="line"><img src="/client/images/de-line-1.png" alt=""/></div>
            </div>
            <div class="text_block">
                {!!  $cityWithNested->top_info !!}
            </div>
        </div>
        <br><br>

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="/client/lib/carousel/carousel.css"/>
        <script src="/client/lib/carousel/owl.carousel_v2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.home-slider-categories').owlCarousel({
                    margin:5,
                    loop:true,
                    autoWidth:true,
                    dots:false,
                    items:6
                })
            });
        </script>
        <section class="">
            <div class="container">
                @foreach($cityWithNested->categories as $category)
                    <h2  id="category-{{$category->id}}">{{ $category->title }}</h2>
                    {{--                    <a class="category"--}}
                    {{--                       href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}"--}}
                    {{--                       onclick="(document.getElementById('page-preloader').style.display='flex')">--}}
                    {{--                        <img class=""--}}
                    {{--                             src="{{$category->image == null ? "/client/images/noimg.png" : $category->image->path}}"--}}
                    {{--                             alt="{{$category->title}}"/>--}}
                    {{--                        <span class="s_h3">{{ $category->title }}</span>--}}
                    {{--                    </a>--}}
                    <section class="products">
                        <div class="products-grid st_grid">
                            @foreach($category->products as $product)
                                <div class="product-item ani st_item" id="item-{{$product->id}}"
                                     data-price="{{$product->price}}"
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
                                            <p class="desc"
                                               title="{{$product->description}}">{{$product->description}}</p>
                                        </a>
                                        <div class="weight">
                                            <span class="s_h3">Вес: {{$product->weight}}г.</span>
                                            <input type='hidden' id='price-{{$product->id}}' value='{{$product->price}}'
                                                   data-external_id='{{$product->uid}}'>
                                        </div>
                                        <div class="cost-line">
                                            <p class="cost">
                                                @price($product->price)₽
                                            </p>
                                            @if($userCart != null)
                                                @if($userCart->products->contains('id', $product->id))
                                                    @foreach($userCart->products as $cartProduct)
                                                        @if($cartProduct->id == $product->id)
                                                            <div class="button-passive hide">
                                                                <div class="s_h3 addToCart" data-id="{{$product->id}}">
                                                                    В корзину
                                                                </div>
                                                            </div>
                                                            <div class="button-active ">
                                                                <div class="updateCart minus animinus"
                                                                     data-id="{{$product->id}}"
                                                                     data-cid="{{$userCart->session_id}}"
                                                                     data-type="-1">
                                                                    <span>-</span>
                                                                </div>
                                                                <div class="kolvo">
                                                                    <span>{{$cartProduct->pivot->quantity}}</span>
                                                                </div>
                                                                <div class="updateCart plus aniplus"
                                                                     data-id="{{$product->id}}"
                                                                     data-cid="{{$userCart->session_id}}"
                                                                     data-type="+1">
                                                                    <span>+</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="button-passive ">
                                                        <div class="s_h3 addToCart" data-id="{{$product->id}}">
                                                            В корзину
                                                        </div>
                                                    </div>
                                                    <div class="button-active hide">
                                                        <div class="updateCart minus animinus"
                                                             data-id="{{$product->id}}" data-cid="0" data-type="-1">
                                                            <span>-</span>
                                                        </div>
                                                        <div class="kolvo"><span>0</span></div>
                                                        <div class="updateCart plus aniplus" data-id="{{$product->id}}"
                                                             data-cid="0" data-type="+1">
                                                            <span>+</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="button-passive ">
                                                    <div class="s_h3 addToCart" data-id="{{$product->id}}">В корзину
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <span itemscope itemtype="http://schema.org/ImageGallery">
	        @foreach($category->products as $product)
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
                @endforeach
            </div>
        </section>
        <div class="container">
            <div class="text_block2">
                {!! $cityWithNested->bottom_info !!}
            </div>
        </div>
        @include('client.components.footer')
    </main>
</div>
<script src="/client/lib/animate_add.js" async></script>
@include('client.components.totop')
@include('client.components.close_win')
@include('client.components.cookies_check')
@include('client.components.cart')
@include('client.components.readmore')
@include('client.components.choose_city')
{{--@include('client.components.sticky')--}}
</body>
</html>


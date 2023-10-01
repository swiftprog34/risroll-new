@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main>
        <div class="delivery_info_grid">
            <a rel="nofollow" class="item"
               href="{{$cityWithNested->gis_link}}">
                <img src="/client/images/color_icons/ic_map.png">
                <span>
                    @foreach($cityWithNested->pickupPoints as $point)
                        {{$point->name}}
                    @endforeach</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
            <a rel="nofollow" class="item" href="tel:+7(345)2500765">
                <img src="/client/images/color_icons/ic_phone.png">
                <span>{{$cityWithNested->phone}}</span>
                <img src="/client/images/icons/ic_link.png">
            </a>
        </div>
        <div class="slider02">
            <div class="home-slider owl-carousel owl-theme ">
                @foreach($cityWithNested->promotions as $promotion)
                    @if($promotion->image !== null)
                    <div class="home-slider__item">
                        <img src="{{$promotion->image == null ? "/client/images/noimg.png" : $promotion->image->path}}" alt="{{$promotion->name}}" title="{{$promotion->name}}"/>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="/client/lib/carousel/carousel.css"/>
        <script src="/client/lib/carousel/owl.carousel_v2.min.js"></script>
        <script>
            $(document).ready(function(){

                $(".home-slider").owlCarousel({

                    margin: 40,
                    smartSpeed: 400,
                    navSpeed: 400,

                    navText: ['<span class="arrow-prev"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>','<span class="arrow-next"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="17" cy="17" r="17" fill="#373535"></circle> <path d="M14.759 9.8418L20.9409 16.9997L14.759 24.1576" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path> </svg></span>'],

                    responsive: {
                        1480: {
                            center: true,
                            items: 1.47,
                            loop: true,
                            nav: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,

                        },
                        767: {
                            center: true,
                            items: 1.3,
                            loop: true,
                            nav: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,

                        },
                        0: {
                            center: true,
                            items: 1,
                            loop: false,
                            nav: false,
                            autoplay: true,
                            dots: true,
                        }
                    }
                });
            });

        </script>
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
        <a name="cats"></a>
        <section class="categories2">
            <div class="container">
                @foreach($cityWithNested->categories as $category)
                    <a class="category"
                       href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}"
                       onclick="(document.getElementById('page-preloader').style.display='flex')">
                        <img class=""
                             src="{{$category->image == null ? "/client/images/noimg.png" : $category->image->path}}"
                             alt="{{$category->title}}"/>
                        <span class="s_h3">{{ $category->title }}</span>
                    </a>
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
</body>
</html>


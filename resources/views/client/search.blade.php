@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <div class="theme_main">
        <main>
            <section class="products">
                <div class="container">
                    <div align="left">
                        <form action="{{route('search', session('city'))}}" method="post" class="search">
                            @csrf
                            <input type="hidden" name="tmpl" value="">
                            <input type="text" name="tmpl" value="" required>
                            <button type="submit"><img src="/client/images/icons/ic_search_black.png"/></button>
                        </form>
                    </div>
                    <br>
                    <p align="left" class="h3">@if($cityWithNested->products->count() == 0)
                            Поиск не дал результатов
                        @else
                            Найдено в названии
                        @endif</p>
                    <div class="products-grid">
                        @foreach($cityWithNested->products as $product)
                            <div class="product-item ani st_item" id="item-{{$product->id}}"
                                 data-price="{{$product->price}}"
                                 data-tags="" data-pos="{{$loop->index}}">
                                <div class="image cover">
                                    <a href="{{route('product', ['subdomain' => session('city'), 'id' => $product->uid])}}">
                                        <img class="lazyImg"
                                             src="{{$product->image == null ? "/client/images/noimg.png" : $product->image->path}}"
                                             data-original="{{$product->image}}"
                                             title="" alt=""/>
                                        <noscript><img src="{{$product->image}}"
                                                       alt=""/></noscript>
                                    </a>
                                </div>
                                <div class="text">
                                    <a href="">
                                        <h3 class="title" title="{{$product->title}}">{{$product->title}}</h3>
                                        <p class="desc" title="{{$product->description}}">{{$product->description}}</p>
                                    </a>
                                    <div class="weight">
                                        <span class="s_h3">xxxx8шт.   Вес: xxxx250г.</span>
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
                                                            <div class="s_h3 addToCart" data-id="{{$product->id}}">
                                                                Добавить
                                                            </div>
                                                        </div>
                                                        <div class="button-active ">
                                                            <div class="updateCart minus animinus"
                                                                 data-id="{{$product->id}}"
                                                                 data-cid="{{$userCart->session_id}}" data-type="-1">
                                                                <span>-</span>
                                                            </div>
                                                            <div class="kolvo">
                                                                <span>{{$cartProduct->pivot->quantity}}</span>
                                                            </div>
                                                            <div class="updateCart plus aniplus"
                                                                 data-id="{{$product->id}}"
                                                                 data-cid="{{$userCart->session_id}}" data-type="+1">
                                                                <span>+</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="button-passive ">
                                                    <div class="s_h3 addToCart" data-id="{{$product->id}}">Добавить
                                                    </div>
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
                                                <div class="s_h3 addToCart" data-id="{{$product->id}}">Добавить</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
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


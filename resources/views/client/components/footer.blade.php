<footer>
    <div class="container">
        <img class="logo_footer" src="/client/images/logo_white.png" title="" alt=""/>
        <div class="social">
            <a rel="nofollow" href="{{$cityWithNested->vk_link}}" target="_blank"><i class="vk"></i></a>
        </div>
        <!--
                <br>

                <div class="app_download">
                    <a rel="nofollow" href="" target="_blank">
                        <img src="/client/images/appstore.png" alt="Скачать из App Store" />
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <a rel="nofollow" href="" target="_blank">
                        <img src="/client/images/googleplay.png" alt="Скачать из Google Play" />
                    </a>
                </div>
        -->
        <ul class="f_cats">
            @foreach($cityWithNested->categories as $category)
                <li>
                    <a href="{{route('category', ['city' => session('city'), 'id' => $category->uid])}}">{{$category->title}}</a>
                </li>
            @endforeach
        </ul>
        <ul class="f_info">
            <li>Ресторан доставки еды</li>
            <li>{{$cityWithNested->city_name}}, @foreach($cityWithNested->pickupPoints as $point)
                    {{$point->name}}
                @endforeach
            </li>
            <li><a rel="nofollow" href="tel:{{$cityWithNested->phone}}">{{$cityWithNested->phone}}</a></li>
        </ul>
        <div class="lastline">
            <p class="">Copyright © 2023 RisRoll. Все права защищены!</p>
            <a rel="nofollow" href="https://ris72.ru/page_terms.php">Пользовательское соглашение</a>
            <a rel="nofollow" href="https://ris72.ru/page_privacy.php">Политика конфиденциальности</a>
        </div>
    </div>
    <div class="bg0"></div>
    <div class="splash"></div>
</footer>

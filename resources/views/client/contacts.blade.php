@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
    <main class="animated fadeIn container">
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
	                <a itemprop="item" title="" href="{{route('contacts', session('city'))}}">
	                    <span itemprop="name">Контакты</span>
	                    <meta itemprop="position" content="2">
	                </a>
	            </span>
            </div>
        </div>
        <div class="page_text">
            <h1>Ресторан доставки RisRoll</h1>
            <p>{!! $cityWithNested->contact_page_info !!}</p>
        </div>
        <div class="contacts_grid">
{{--            <div class="item">--}}
{{--                <div class="worktime h5">--}}
{{--                    <div class="worktime_item ">--}}
{{--                        ПН--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item ">--}}
{{--                        ВТ--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item ">--}}
{{--                        СР--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item ">--}}
{{--                        ЧТ--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item ">--}}
{{--                        ПТ--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item  active ">--}}
{{--                        СБ--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                    <div class="worktime_item ">--}}
{{--                        ВС--}}
{{--                        <hr>--}}
{{--                        11:00 <br>--}}
{{--                        23:00--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="item">
                <img class="icon" src="client/images/color_icons/ic_map.png" alt=""/>
                <h3><strong>{{$cityWithNested->city_name}}</strong><br> @foreach($cityWithNested->pickupPoints as $point)
                        {{$point->name}}<br>
                    @endforeach</h3>
            </div>
            <a class="item" href="tel:{{$cityWithNested->getPhoneNumberAttribute()}}">
                <img class="icon" src="client/images/color_icons/ic_phone.png" alt=""/>
                <h3>{{$cityWithNested->getPhoneNumberAttribute()}}</h3>
            </a>
            <a class="item" href="{{$cityWithNested->vk_link}}" target="_blank">
                <img class="icon" src="client/images/color_icons/ic_vk.png" alt=""/>
                <h3>Группа ВК</h3>
            </a>
            <a class="item" href="{{$cityWithNested->instagram_link}}" target="_blank">
                <img class="icon" src="client/images/color_icons/ic_instagram.png" alt=""/>
                <h3>Инстаграм</h3>
            </a>
        </div>
        <div class="container">
            <div class="text_block2">
                {!! $cityWithNested->contact_map !!}
            </div>
        </div>
    </main>
    @include('client.components.footer')
    <script src="/client/lib/animate_add.js" async></script>
@include('client.components.totop')
@include('client.components.close_win')
@include('client.components.cookies_check')
@include('client.components.cart')
@include('client.components.choose_city')
</body>
</html>
@include('client.components.readmore')

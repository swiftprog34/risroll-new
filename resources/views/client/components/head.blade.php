<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="">
    <!--Main-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Рис &#8212; Доставка вкусной еды</title>
    <meta name="description"
          content="Risroll - Заказать доставку суши сетов и роллов в городе Тюмень по доступным ценам!">
    <meta name="keywords" content=" ">
    <link rel="canonical" href="{{route('index')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="/client/images/favicon/apple-icon-57x57.png@v=2">
    <link rel="apple-touch-icon" sizes="60x60" href="/client/images/favicon/apple-icon-60x60.png@v=2">
    <link rel="apple-touch-icon" sizes="72x72" href="/client/images/favicon/apple-icon-72x72.png@v=2">
    <link rel="apple-touch-icon" sizes="76x76" href="/client/images/favicon/apple-icon-76x76.png@v=2">
    <link rel="apple-touch-icon" sizes="114x114" href="/client/images/favicon/apple-icon-114x114.png@v=2">
    <link rel="apple-touch-icon" sizes="120x120" href="/client/images/favicon/apple-icon-120x120.png@v=2">
    <link rel="apple-touch-icon" sizes="144x144" href="/client/images/favicon/apple-icon-144x144.png@v=2">
    <link rel="apple-touch-icon" sizes="152x152" href="/client/images/favicon/apple-icon-152x152.png@v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="/client/images/favicon/apple-icon-180x180.png@v=2">
    <link rel="icon" type="image/png" sizes="192x192" href="/client/images/favicon/android-icon-192x192.png@v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="/client/images/favicon/favicon-32x32.png@v=2">
    <link rel="icon" type="image/png" sizes="96x96" href="/client/images/favicon/favicon-96x96.png@v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="/client/images/favicon/favicon-16x16.png@v=2">
    <link rel="manifest" href="/client/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png?v=2">
    <link rel="icon" href="/client/images/favicon/favicon.ico@v=2" type="image/x-icon">
    <!--Theme-->
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#fff">
    <meta name="msapplication-navbutton-color" content="#fff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <!---->    <!---->
    <!--Open Graph-->
    <!---->
    <!--CSS-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/client/tmpl200423/main.css">
    <link rel="stylesheet" href="/client/tmpl200423/main_plus.css">
    <link rel="stylesheet" href="/client/tmpl200423/navigation.css">
    <link rel="stylesheet" href="/client/tmpl200423/style.css">
    <link rel="stylesheet" href="/client/tmpl200423/products.css">
    <link rel="stylesheet" href="/client/tmpl200423/products_plus.css">
    <link rel="stylesheet" href="/client/tmpl200423/style.css">¶
    <link rel="stylesheet" href="/client/tmpl200423/product-one.css">
    <link rel="stylesheet" href="/client/tmpl200423/cart.css">
    <link rel="stylesheet" href="/client/tmpl200423/cart_plus.css">
    <!---->
    <script src="/client/lib/jquery-2.1.4.min.js"></script>
    <div class='page_query' data-page_query=''></div>
    <script src="/client/lib/jquery.cookie.js"></script>
    <script src="/client/script.account.js"></script>
    <script src="/client/script.js"></script>
    <!---->
    <script src="/client/lib/jquery.lazyload.min.js"></script>
    <script>
        $(window).load(function () {
            $("img.lazyImg").lazyload({
                effect: "fadeIn",
                threshold: 400,
                skip_invisibleна: false
            });

        });
    </script>
    <!-- Плавный переход по якорям -->
    <script>
        $(document).ready(function () {
            $("a[href*=#]").on("click", function (e) {
                var anchor = $(this);
                var name = anchor.attr("href").replace(new RegExp("#", "gi"), "");
                var fixed_offset = 72;
                $('html, body').stop().animate({
                    scrollTop: $("a[name=" + name + "]").offset().top - fixed_offset
                }, 700);
                e.preventDefault();
                return false;
            });
        });
    </script>
    <!---->
    <link href="/client/lib/animate/animate.css" type="text/css" rel="stylesheet">
    <script src="/client/lib/animate/wow.min.js"></script>
    <script>new WOW().init();</script>
    <!--Для крестика-->
    <!---->
    <script>
        $(document).ready(function () {

            var cur_width = $(window).width();

            $(window).resize(function () {
                if ($(window).width() <= 720 && cur_width > 720) {
                    //reload
                    location.reload();
                } else if ($(window).width() > 720 && cur_width <= 720) {
                    //reload
                    location.reload();
                }
            });

        });
    </script>
    <style>
        .scrollTop {
            position: relative;
        }
        /*nav.mobile .icon.back img {*/
        /*    display: none !important;*/
        /*}*/
    </style>
    <style type="text/css">
        @media screen and (max-width: 800px) {
            .open_sidebar {
                display: none !important;
            }

            .back {
                display: flex !important;
            }

            .indent-24 {
                display: none;
            }
        }
    </style>
</head>

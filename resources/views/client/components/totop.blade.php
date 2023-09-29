<!--Кнопка "Вверх"-->
<script src="/client/lib/totop/easing.js"></script>
<script src="/client/lib/totop/jquery.ui.totop.js"></script>
<script>
    $(document).ready(function () {
        var defaults = {
            containerID: 'toTop',
            containerHoverID: 'toTopHover',
            scrollSpeed: 2200,
            easingType: 'linear'
        };
        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>

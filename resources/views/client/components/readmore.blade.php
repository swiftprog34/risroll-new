<!--Readmore-->
<script src="/client/lib/readmore.js"></script>
<script>
    $('.text_block000').readmore({
        maxHeight: 270,
        moreLink: '<div class="readmore_container"><a class="readmore_button_open" href="index.html#">Читать ещё</a></div>',
        lessLink: '<div class="readmore_container"><a class="readmore_button_close" href="index.html#">Свернуть</a></div>',
        afterToggle: function (trigger, element, more) {
            if (!more) {
                $('html, body').animate({
                    scrollTop: element.offset().top - 200
                }, {
                    duration: 500
                });
            }
        }
    });
    $('.text_block2000').readmore({
        maxHeight: 185,
        moreLink: '<div class="readmore_container"><a class="readmore_button_open" href="index.html#">Читать ещё</a></div>',
        lessLink: '<div class="readmore_container"><a class="readmore_button_close" href="index.html#">Свернуть</a></div>',
        afterToggle: function (trigger, element, more) {
            if (!more) {
                $('html, body').animate({
                    scrollTop: element.offset().top - 200
                }, {
                    duration: 500
                });
            }
        }
    });
</script>

<!--noindex-->
<!--googleoff: index-->
@if(session()->has('need_choose_city'))
    <div class="modal-container">
        <div id="choose_city">
            <p>В каком вы городе?</p>
            <form action="/" method="get">
                <select id="city_chooser_popup" name="locations">
                    @foreach($cities as $city)
                        <option value="{{$city->slug}}" @if($city->id === $cityWithNested->id) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>

                <button class="button choose_city_accept" id="city_choose_button">Выбрать</button>
            </form>
        </div>
    </div>
@endif
<!--googleon: index-->
<!--/noindex-->
<script>
    var select = document.getElementById('city_chooser_popup');
    var chooseButton = document.getElementById('city_choose_button');
    chooseButton.onclick = function(){
        this.form.action = 'http://' + select.value + '.risroll.ru';
        this.form.submit();
    };

    $(window).scroll(function () {
        if (window.innerWidth >= 800) {
            var h = 144;
        } else {
            var h = 0;
        }

        if ($(this).scrollTop() > h) {
            $('nav.desktop').addClass("scrollTop");
        } else {
            $('nav.desktop').removeClass("scrollTop");
        }
    });
</script>

<script>
    $('body').on('click', '.addToCart', function () {
        let btn = $(this),
            id = btn.data('id'),
            price = parseInt($('#price-' + id).val()),
            poz_quantity = parseInt($('.final_cost_bar .quantity .kolvo span').text()),
            external_id = $('#price-' + id).data('external_id');

        $.ajax({
            url: '{{ url("/cart/add-product") }}',
            type: 'post',
            data: {
                id: id,
                external_id: external_id,
                price: price,
                quantity: 1,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (resp) {
                console.info(resp);

                // resp = JSON.parse(msg);

                if (resp.status == 0) {
                    alert(resp.data);
                    return false;
                }

                //if(parseInt(external_id) !== 0) {
                //if(parseInt(external_id) !== 0 && mods.length > 0) {
                // if (btn.hasClass('addToCart_mods')) {
                //     btn.addClass('hide');
                //     btn.parent().find('.order_info').removeClass('hide').html('<h3>Товар успешно добавлен</h3>');
                //     // сбрасываем выбранные данные
                //     setTimeout(function () {
                //         cart_product_reset(btn);
                //         cart_product_update();
                //         // cid type
                //         //btn.prop('data-cid', id).prop('type', '+').addClass('updateCart');
                //     }, 1500);
                // } else {
                btn.parent().addClass('hide');
                btn.parent().parent().find('.button-active').removeClass('hide');
                btn.parent().parent().find('.button-active .kolvo').text(1);
                btn.parent().parent().find('.button-active .minus').attr('data-cid', resp.key);
                btn.parent().parent().find('.button-active .plus').attr('data-cid', resp.key);
                // }

                $('span.basketPrice').html(resp.data + '₽');

                $('#couponDiscount').val(1);

                $('#applyCouponInfo').empty();

                $('#applyCouponInfo').removeClass('text-info text-error');

                // Подарки - начало
                $('#nextGiftSum span').html(resp.giftnext);

                $('#giftRange').css('width', resp.giftprc + '%');
                // Подарки - конец
            }
        });
    });


    // функция сброса стоимости и модификаторов на странице карточки товара
    function cart_product_reset(btn) {
        btn.parent().find('.order_info').addClass('hide');
        btn.removeClass('hide');
        $('.final_cost_bar .quantity .kolvo span').text(1);
        // сбрасываем допы
        if (typeof ($('.modifiers .mod_group.multiple')) !== 'undefined') {
            $.each($('.modifiers .mod_group.multiple input'), function () {
                $(this).prop('checked', '');
            });
        }
        let for_check = [];
        if (typeof ($('.modifiers .mod_group.single')) !== 'undefined') {
            $.each($('.modifiers .mod_group.single input'), function (index) {
                for_check.push($(this).prop('name'));
                $(this).prop('checked', '');
            });
            $.each(for_check, function (index, value) {
                $('.modifiers .mod_group.single input[name=' + value + ']').eq(0).prop('checked', 'checked');
            });
        }
        if (typeof ($('.modifiers .mod_group.default')) !== 'undefined') {
            $.each($('.modifiers .mod_group.default .mod_item'), function () {
                $(this).find('.kolvo span').text(0);
            });
        }
    }

    // функция обновления стоимости на странице карточки товара
    function cart_product_update() {
        let poz_cost = parseInt($('.item_weight input').val()),
            poz_quantity = parseInt($('.final_cost_bar .quantity .kolvo span').text());

        if (typeof ($('.item_weight input').val()) === 'undefined') {
            poz_cost = parseInt($('.item_weight select').val());
        }
        // собираем выбранные модификаторы
        let mod_cost = 0;
        if (typeof ($('.modifiers .mod_group.multiple')) !== 'undefined') {
            $.each($('.modifiers .mod_group.multiple input:checked'), function () {
                mod_cost += parseInt($(this).val());
            });
        }
        if (typeof ($('.modifiers .mod_group.single')) !== 'undefined') {
            $.each($('.modifiers .mod_group.single input:checked'), function () {
                mod_cost += parseInt($(this).parent().find('.cost').text());
            });
        }
        if (typeof ($('.modifiers .mod_group.default')) !== 'undefined') {
            $.each($('.modifiers .mod_group.default .mod_item'), function () {
                let current_value = parseInt($(this).find('.kolvo span').text());
                if (current_value > 0) {
                    mod_cost += current_value * parseInt($(this).find('.cost').text());
                }
            });
        }
        let final_cost = (poz_cost + mod_cost) * poz_quantity;
        $('.final_cost').text(final_cost);
    }
</script>

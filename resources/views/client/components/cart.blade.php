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

                btn.parent().addClass('hide');
                btn.parent().parent().find('.button-active').removeClass('hide');
                btn.parent().parent().find('.button-active .kolvo').text(1);
                btn.parent().parent().find('.button-active .minus').attr('data-cid', resp.key);
                btn.parent().parent().find('.button-active .plus').attr('data-cid', resp.key);

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

    $('body').on('click', '.updateCart', function () {
        let btn = $(this),
            cid = btn.attr('data-cid'),
            id = btn.data('id'),
            type = btn.data('type');
        $.ajax({
            url: '{{ url("/cart/change-quantity") }}',
            type: 'post',
            data: {
                id: id,
                quantity: type,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (resp) {

                if (resp.status == 0) {
                    alert(resp.data);
                    return false;
                }

                $('span.basketPrice').html(resp.data + '₽');

                btn.parent().find('.kolvo').html(resp.all);

                // Подарки - начало
                $('#nextGiftSum span').html(resp.giftnext);

                $('#giftRange').css('width', resp.giftprc + '%');
                // Подарки - конец

                if ($('div.cart').length) {
                    btn.parent().find('.kolvo').html(resp.allcart); // Fix 03.11.2021

                    if (resp.allcart < 1) // Fix 03.11.2021
                    {
                        btn.parent().parent().fadeOut(500);

                        $('#rcmd-' + resp.id).removeClass('active');
                        $('#rcmd-' + resp.id + ' .addRcmd').removeClass('hide');
                        $('#rcmd-' + resp.id + ' .issetRcmd').addClass('hide');
                        if ($(".slider_recommend .slider_item:visible").length > 0) {
                            $('#title_recommend').show();
                        }
                    } else {
                        calc = btn.parent().parent().find('.calc');
                        calc.find('.formula').html(resp.all + ' х ' + resp.price + '₽');
                        aPrice = parseFloat(resp.allcart * resp.price); // Fix 03.11.2021
                        calc.find('.result').html(parseFloat(aPrice.toFixed(0)) + '₽'); // Fix 03.11.2021
                    }

                    $('#total').val(resp.data);
                    $('#dtotal').val(resp.dtotal);
                    $('.orderCost span, .orderCost2 span').html(resp.data);
                    $('.order span').html(resp.data);
                    $('#bonusCost').val('0');
                    $('.bonusCost').html('0₽');
                    $('#chargeBonusBox span').html('Списать бонусы');
                    $('input[name=chargebonus]').prop('checked', false);
                    $('#couponDiscount').val('1');
                    $('#resetCouponBtn').addClass('hide');
                    $('#applyCouponBtn').removeClass('hide');
                    $('#applyCouponInfo').empty();
                    $('#applyCouponInfo').removeClass('text-info text-error');

                    cartTotal();

                    // Подарки - начало
                    $('.slider_scale_items .item').each(function (i) {
                        var giftWeight = $(this).data('weight');

                        var giftId = $(this).data('id');

                        if (resp.giftsum >= giftWeight) {
                            if ($.cookie('giftid') == giftId) {
                                $(this).find('.button.c3').removeClass('hide');
                                $(this).find('.button.c2').addClass('hide');
                            } else {
                                $(this).find('.button.c3').addClass('hide');
                                $(this).find('.button.c2').removeClass('hide');
                            }

                            $(this).find('.button.c1').addClass('hide');
                        } else {
                            $(this).find('.button.c3').addClass('hide');
                            $(this).find('.button.c2').addClass('hide');
                            $(this).find('.button.c1').removeClass('hide');
                        }
                    });

                    if (resp.giftnext > 0) {
                        $('#nextSumBlock').removeClass('hide');
                        $('#nextSumFull').addClass('hide');
                    } else {
                        $('#nextSumBlock').addClass('hide');
                        $('#nextSumFull').removeClass('hide');
                    }

                    if (parseInt($.cookie('giftweight')) > parseInt(resp.giftsum)) {
                        $.cookie('giftid', 0);
                        $.cookie('giftcost', 0);
                        $.cookie('giftweight', 0);
                    }
                    // Подарки - конец

                    if (resp.data <= 0) {
                        $('.cart').addClass('hide');
                        $('.emptyCart').removeClass('hide');
                    }
                } else {
                    if (resp.all < 1) {
                        btn.parent().parent().find('.button-passive').removeClass('hide');
                        btn.parent().parent().find('.button-active').addClass('hide');
                    } else {
                        if (cid != resp.cart_id) {
                            btn.attr('data-cid', resp.cart_id);

                            btn.data('cid', resp.cart_id);
                        }
                    }
                }
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

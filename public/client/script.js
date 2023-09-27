// Фильтры - начало
var page_query = $('div.page_query').data('page_query');

$(function()
{
	$.fn.foodSort = function( isinit )
	{
		if( isinit != 1 )
		{
			window.location.reload();
			return false;
		}

		var fPrice = sessionStorage.getItem( 'if_price' );
		var fTags = sessionStorage.getItem( 'if_tags' );
		var jTags = new Object();

		if( fTags !== null )
		{
			jTags = JSON.parse( fTags );
		}

		$(this).each( function( key )
		{
			if( fPrice !== null )
			{
				var $wrapper = $(this);

				$wrapper.find('.st_item').sort(function (a, b)
				{
					if( fPrice == 'asc' )
    				{
						return +a.dataset.price - +b.dataset.price;
					}
					else
					{
						return +b.dataset.price - +a.dataset.price;
					}
				}).appendTo( $wrapper );
			}
			else
			{
				var $wrapper = $(this);

				$wrapper.find('.st_item').sort(function (a, b)
				{
    				return +a.dataset.pos - +b.dataset.pos;
				}).appendTo( $wrapper );
			}

			$(this).find( '.st_item' ).each( function( key )
			{
				var iShow = 1;
				var sTags =  $(this).data( 'tags' );

				if( typeof sTags != "undefined" )
				{
					var iTags = sTags.split( ';' );
				}
				else
				{
					var iTags = [];
				}

				$.each( jTags, function( index )
				{
					if( $( '#itemFilterTags .tags_item[data-sort='+index+']' ).length & $.inArray( index, iTags ) == -1 )
					{
						iShow = 0;
					}
				});

				if( !iShow )
				{
					$(this).addClass( 'hide' );
				}
				else
				{
					$(this).removeClass( 'hide' );
				}
			});
		});
	};

	var url = document.location.href + page_query;

	if( sessionStorage.getItem( 'if_url' ) == null || url.split('#')[0] != sessionStorage.getItem( 'if_url' ) )
	{
		sessionStorage.setItem( 'if_url', url.split('#')[0] );
		sessionStorage.removeItem( 'if_price' );
		sessionStorage.removeItem( 'if_tags' );
	}

	var fPrice = sessionStorage.getItem( 'if_price' );

	if( fPrice !== null )
	{
		$( '#itemFilterPrice .tags_item[data-sort='+fPrice+']' ).addClass( 'active' );
		$( '#itemFilterPrice .tags_item[data-sort='+fPrice+'] > span' ).removeClass( 'hide' );
	}

	var fTags = sessionStorage.getItem( 'if_tags' );
	var jTags = new Object();

	if( fTags !== null )
	{
		jTags = JSON.parse( fTags );

		$.each( jTags, function( index, value )
		{
			$( '#itemFilterTags .tags_item[data-sort='+index+']' ).addClass( 'active' );
			$( '#itemFilterTags .tags_item[data-sort='+index+'] > span' ).removeClass( 'hide' );
		});
	}

	$( '.st_grid' ).foodSort( 1 );

	$( 'body' ).on( 'click', '#delItemsFilters', function()
	{
		sessionStorage.removeItem( 'if_price' );
		sessionStorage.removeItem( 'if_tags' );

		$( '#itemFilterTags .tags_item' ).removeClass( 'active' );
		$( '#itemFilterTags .tags_item > span' ).addClass( 'hide' );
		$( '#itemFilterPrice .tags_item' ).removeClass( 'active' );
		$( '#itemFilterPrice .tags_item > span' ).addClass( 'hide' );
		$( '.st_grid' ).foodSort();
	});

	$( 'body' ).on( 'click', '#itemFilterPrice .tags_item', function()
	{
		if( $(this).hasClass( 'active' ) )
		{
			$(this).find( 'span' ).addClass( 'hide' );
			$(this).removeClass( 'active' );
			sessionStorage.removeItem( 'if_price' );
			$( '.st_grid' ).foodSort();
			return false;
		}

		$( '#itemFilterPrice' ).find( '.tags_item.active' ).removeClass( 'active' );
		$( '#itemFilterPrice' ).find( '.tags_item.active' ).find( 'span' ).addClass( 'hide' );
		$(this).addClass( 'active' );
		$(this).find( 'span' ).removeClass( 'hide' );
		var sort = $(this).data( 'sort' );
		sessionStorage.setItem( 'if_price', sort );
		$( '.st_grid' ).foodSort();
	});

	$( 'body' ).on( 'click', '#itemFilterTags .tags_item', function()
	{
		var sort = $(this).data( 'sort' );

		if( $(this).hasClass( 'active' ) )
		{
			$(this).find( 'span' ).addClass( 'hide' );
			$(this).removeClass( 'active' );
			delete jTags[sort];
			sessionStorage.setItem( 'if_tags', JSON.stringify(jTags));
			$( '.st_grid' ).foodSort();
			return false;
		}

		$(this).addClass( 'active' );
		$(this).find( 'span' ).removeClass( 'hide' );
		jTags[sort] = 1;
		sessionStorage.setItem( 'if_tags', JSON.stringify(jTags));

		$( '.st_grid' ).foodSort();
	});
});
// Фильтры - конец

$(function()
{
    /* Updates 12.12.2021 - start */
    function cartTotal()
    {
        var total = parseFloat( $( '#total' ).val() );

        $( '.orderCost span, .orderCost2 span' ).html( total );

        var dtotal = parseFloat( $( '#dtotal' ).val() );

        var doffset = total - dtotal;

        var maxPrc = parseFloat( $( '#bonusMaxPrc' ).val() );

        var bonusMax = Math.floor( parseFloat( total ) / 100 * maxPrc );

        $( '.deliveryCost' ).html( '+ 0₽' );
        $( '.deliveryCostBtm' ).html( '0₽' );

        let deliveryCost = 0;
        let dFree = 1;
        let pDiscountSum = 0;

        // Updated 08.03.2023 - start (Новый код)
        if( $( '#r1' ).prop( 'checked' ) & total >= parseFloat( $( '#deliveryFree' ).val() ) )
		{
			dFree = 0;

			deliveryCost = parseFloat( $( '#deliveryCost2' ).val() );
			total = total + parseFloat( $( '#deliveryCost2' ).val() );

            $( '.deliveryCost' ).html( '+ ' + $( '#deliveryCost2' ).val() + '₽' );

            $( '.deliveryCostBtm' ).html( $( '#deliveryCost2' ).val() + '₽' );

            var aSum = total + parseFloat( $( '#deliveryCost2' ).val() );

            $( '.order span' ).html( aSum );

            bonusMax = aSum / 100 * maxPrc;
        }
        // Updated 08.03.2023 - end


		if( $( '#r1' ).prop( 'checked' ) & total < parseFloat( $( '#deliveryFree' ).val() ) )
		{
			dFree = 0;

			deliveryCost = parseFloat( $( '#deliveryCost' ).val() );
			total = total + parseFloat( $( '#deliveryCost' ).val() );

            $( '.deliveryCost' ).html( '+ ' + $( '#deliveryCost' ).val() + '₽' );

            $( '.deliveryCostBtm' ).html( $( '#deliveryCost' ).val() + '₽' );

            var aSum = total + parseFloat( $( '#deliveryCost' ).val() );

            $( '.order span' ).html( aSum );

            bonusMax = aSum / 100 * maxPrc;
        }
        else if( $( '#r2' ).prop( 'checked' ) )
        {
            $( '.deliveryCost' ).html( '+ 0₽' );

            $( '.deliveryCostBtm' ).html( '0₽' );

            var discount = $('#pickup-points').find( 'option:selected' ).data( 'discount' );

            var fdsc = ( discount > 0 ) ? discount * 100 : 0;

            $( 'label[for=r2] span, #pickup-discount span' ).html( fdsc );

            $( '.orderDiscount2 span' ).html( 0 );

            if( discount > 0 )
            {
                var sum = Math.floor( parseFloat( total ) * ( 1 - parseFloat( discount ) ) );

                $( '.order span' ).html( sum );

                pDiscountSum = Math.floor( parseFloat( total ) - sum );

                $( '.orderDiscount2 span' ).html( pDiscountSum );

                total = sum;
            }
        }

        bonusMax = Math.floor( total / 100 * maxPrc );

        if( bonusMax > parseFloat( $( '#bonusBal' ).val() ) )
        {
            bonusMax = parseFloat( $( '#bonusBal' ).val() );
        }

        $( '#bonusMax' ).val( bonusMax );

        $( '#myBonuses' ).val( bonusMax );

		total = total - parseFloat( $( '#bonusCost' ).val() );

        switch( $( '#couponType' ).val() ) {
            case 'percent':

                if( dtotal == total )
				{
					var promoCost = total - Math.floor( total * parseFloat( $( '#couponDiscount' ).val() ) );

                    total = Math.floor( total * parseFloat( $( '#couponDiscount' ).val() ) );

                    if( promoCost <= 0 ) {

						promoCost = 0;
					}

                    $( '.promoCost span' ).html( parseFloat( promoCost ) + '₽' );
                }
                else
                {
					let preTotal = Math.round( ( total - pDiscountSum ) * parseFloat( $( '#couponDiscount' ).val() ) );

					if( dFree == 1 & $( '#r1' ).prop( 'checked' ) & preTotal < parseFloat( $( '#deliveryFree' ).val() ) )
					{
						total = total + parseFloat( $( '#deliveryCost' ).val() );

						deliveryCost = parseFloat( $( '#deliveryCost' ).val() );

						$( '.deliveryCostBtm' ).html( parseFloat( $( '#deliveryCost' ).val() ) + '₽' );
					}

					var promoCost = ( dtotal + deliveryCost - pDiscountSum - parseFloat( $( '#bonusCost' ).val() ) ) - Math.floor( ( dtotal + deliveryCost - pDiscountSum - parseFloat( $( '#bonusCost' ).val() ) ) * parseFloat( $( '#couponDiscount' ).val() ) );

					if( promoCost <= 0 ) {

						promoCost = 0;
					}

					$( '.promoCost span' ).html( parseFloat( promoCost ) + '₽' );

					total = Math.round( total - promoCost );
                }

				break;
            case 'cash':
				total = Math.floor( total - parseFloat( $( '#couponDiscount' ).val() ) );
				break;
        }

        $( '.order span' ).html( total );

        return total;
    }

	/* Card address - start */
	if( $( '#deliveryMethod' ).length )
	{
		$( 'input[name=locations]' ).val( localStorage.getItem( 'locations' ) );

		$( 'input[name=street]' ).val( localStorage.getItem( 'street' ) );

		$( 'input[name=home]' ).val( localStorage.getItem( 'home' ) );

		$( 'input[name=entrance]' ).val( localStorage.getItem( 'entrance' ) );

		$( 'input[name=floor]' ).val( localStorage.getItem( 'floor' ) );

		$( 'input[name=apart]' ).val( localStorage.getItem( 'apart' ) );
	}
	/* Cart address - end */

	$( 'input[name=uname]' ).val( localStorage.getItem( 'uname' ) );
	$( 'input[name=phone]' ).val( localStorage.getItem( 'phone' ) );

	// Купоны - начало
	$( 'body' ).on( 'click', '#applyCouponBtn', function()
	{
		input = $( 'input[name=couponCode]' );

		input.removeClass( 'error' );

		$( '#applyCouponInfo' ).empty();

		$( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

		code = input.val();

		if( code.length < 1 )
		{
			input.addClass( 'error' );

			$( '#applyCouponInfo' ).addClass( 'text-error' );

			$( '#applyCouponInfo' ).html( 'Необходимо указать название купона' );

			return false;
		}

        $( '#couponType' ).val( 'percent' );

		var total = cartTotal();

		$.post( 'ajax.php?do=applycoupon', 'coupon=' + code + '&total=' + total, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				$( '#applyCouponInfo' ).addClass( 'text-error' );

				$( '#applyCouponInfo' ).html( resp.data );

				return false;
			}

			$( '#couponType' ).val( resp.type );
			$( '#applyCouponInfo' ).addClass( 'text-info' );
			$( '#applyCouponInfo' ).html( resp.data );
			$( '#couponDiscount' ).val( resp.discount );
			$( '#resetCouponBtn' ).removeClass( 'hide' );
			$( '#applyCouponBtn' ).addClass( 'hide' );
			$( '#dtotal' ).val( resp.dtotal );
            $( '.promoCost' ).removeClass( 'hide' );

            cartTotal();
		});
	});

	$( 'body' ).on( 'click', '#resetCouponBtn', function()
	{
		input = $( 'input[name=couponCode]' );

		input.removeClass( 'error' );

		$( '#applyCouponInfo' ).empty();

		$( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

		input.val( '' );

		$.post( 'ajax.php?do=resetcoupon', function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				$( '#applyCouponInfo' ).addClass( 'text-error' );

				$( '#applyCouponInfo' ).html( resp.data );

				return false;
			}

			$( '#couponDiscount' ).val( '1' );

            $( '#couponType' ).val( 'percent' );

			$( '#resetCouponBtn' ).addClass( 'hide' );

			$( '#applyCouponBtn' ).removeClass( 'hide' );

            cartTotal();
		});
	});
	// Купоны - конец

	// Бонусы - начало
	$( 'input[name=chargebonus]' ).on( 'change', function()	{
		if( $(this).prop( 'checked' ) )	{
			$.post( 'user/ajax.php?do=balance', function( msg )	{
				resp = JSON.parse( msg );

				if( resp.status == 0 )	{
					$( 'input[name=chargebonus]' ).prop( 'checked', false );
					return false;
				}

				$( '.bAuthWin .large' ).html( resp.data );

                $( '#bonusBal' ).val( resp.data );

                cartTotal();

                $( '#modal-1 .error-text' ).html( '' );

				$( '#modal-1' ).addClass( 'md-show' );
			});
		}
		else
		{
			$( '#bonusCost' ).val( '0' );
			$( '.bonusCost' ).html( '0₽' );

            $( '#couponDiscount' ).val( '1' );
            $( '#couponType' ).val( 'percent' );
            $( '#resetCouponBtn' ).addClass( 'hide' );
            $( '#applyCouponBtn' ).removeClass( 'hide' );
            $( '#applyCouponInfo' ).empty();
            $( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

			$( '#chargeBonusBox span' ).html( 'Списать бонусы' );

            cartTotal();
		}
	});

	$( '#modal-1 .close' ).on( 'click', function()	{
		$( '#modal-1' ).removeClass( 'md-show' );
		$( '#bonusCost' ).val( '0' );
		$( '.bonusCost' ).html( '0₽' );
		$( '#chargeBonusBox span' ).html( 'Списать бонусы' );
		$( 'input[name=chargebonus]' ).prop( 'checked', false );
	});

	$( '#modal-1 .btn_ok' ).on( 'click', function() {
		$( '#modal-1 .error-text' ).empty();
		val = parseInt( $( '#myBonuses' ).val() );

		if( val > parseInt( $( '#bonusMax' ).val() ) ) {
			$( '#modal-1 .error-text' ).html( 'Вы не можете списать больше, чем ' + $( '#bonusMax' ).val() + ' баллов' );
		}
		else if( val < 1 )	{
			$( '#modal-1 .error-text' ).html( 'Вы не можете списать меньше 1 балла!' );
		}
		else {
			$( '#bonusCost' ).val( val );
			$( '.bonusCost' ).html( val + '₽' );

			$.post( 'ajax.php?do=resetcoupon', function( msg )
            {
                resp = JSON.parse( msg );

                if( resp.status == 0 )
                {
                    $( '#applyCouponInfo' ).addClass( 'text-error' );

                    $( '#applyCouponInfo' ).html( resp.data );

                    return false;
                }

                $( '#applyCouponInfo' ).empty();

                $( '#couponDiscount' ).val( '1' );

                $( '#resetCouponBtn' ).addClass( 'hide' );

                $( '#applyCouponBtn' ).removeClass( 'hide' );

                cartTotal();
            });

			$( '#chargeBonusBox span' ).html( 'Списать ' + val + ' бонусов' );

			$( '#modal-1' ).removeClass( 'md-show' );
		}
	});
	// Бонусы - конец

	/* Районы доставки */
	$( 'body' ).on( 'change', 'select[name=locations]', function()
	{
		id = $(this).val();

		$.post( 'ajax.php?do=locationInfo', 'id=' + id, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			$( '#deliveryCost' ).val( resp.data );
			/* Updated 08.03.2023 - start */
			$( '#deliveryCost2' ).val( resp.data_2 );
			/* Updated 08.03.2023 - end */
			$( '#deliveryFree' ).val( resp.free );
			$( '#deliveryMin' ).val( resp.min );

			$( '#delFree' ).html( resp.free );
			$( '#delInfo' ).html( resp.info );
			$( '#delMin' ).html( resp.min );

			cartTotal();
		});
	});
	/* ----- */

	/* Точки самовывоза */
	$( 'body' ).on( 'change', 'select[name=points]', function()
	{
		var content = $( '#pickup-points option:selected' ).data( 'content' );
		$( '#pickup-content' ).html( b64DecodeUnicode( content ) );

		/*var content2 = $( '#pickup-points option:selected' ).data( 'content2' );
		$( '#pickup-content2' ).html( b64DecodeUnicode( content2 ) );*/

        var discount = $('#pickup-points').find( 'option:selected' ).data( 'discount' );

        var fdsc = ( discount > 0 ) ? discount * 100 : 0;

        $( 'label[for=r2] span, #pickup-discount span' ).html( fdsc );

        $( '.orderDiscount2 span' ).html( 0 );

        cartTotal();

		var id = $(this).val();

		$.post( 'ajax.php?do=pointInfo', 'id=' + id, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			$( '#name' ).val( resp.data );
			$( '#url' ).val( resp.url );
			$( '#geturl' ).html( resp.url );
		});
	});
	/* ----- */

	$( 'body' ).on( 'click', '.updateCart', function()
	{
		let btn = $(this),
			cid = btn.attr( 'data-cid' ),
			type = btn.data( 'type' );

		$.post( 'ajax.php?do=updatecart', 'cid=' + cid + '&type=' + type, function( msg )
		{
			let resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			$( 'span.basketPrice' ).html( resp.data + '₽' );

			btn.parent().find( '.kolvo' ).html( resp.all );

            // Подарки - начало
			$( '#nextGiftSum span' ).html( resp.giftnext );

			$( '#giftRange' ).css( 'width', resp.giftprc + '%' );
			// Подарки - конец

			if( $( 'div.cart' ).length )
			{
                btn.parent().find( '.kolvo' ).html( resp.allcart ); // Fix 03.11.2021

				if( resp.allcart < 1 ) // Fix 03.11.2021
				{
					btn.parent().parent().fadeOut(500);

                    $( '#rcmd-' + resp.id ).removeClass( 'active' );
                    $( '#rcmd-' + resp.id + ' .addRcmd' ).removeClass( 'hide' );
                    $( '#rcmd-' + resp.id + ' .issetRcmd' ).addClass( 'hide' );
                    if( $( ".slider_recommend .slider_item:visible" ).length > 0 )
                    {
                        $( '#title_recommend' ).show();
                    }
				}
				else
				{
					calc = btn.parent().parent().find( '.calc' );
					calc.find( '.formula' ).html( resp.all + ' х ' + resp.price + '₽' );
					aPrice = parseFloat( resp.allcart * resp.price ); // Fix 03.11.2021
					calc.find( '.result' ).html( parseFloat( aPrice.toFixed(0) ) + '₽' ); // Fix 03.11.2021
				}

				$( '#total' ).val( resp.data );
                $( '#dtotal' ).val( resp.dtotal );
				$( '.orderCost span, .orderCost2 span' ).html( resp.data );
				$( '.order span' ).html( resp.data );
				$( '#bonusCost' ).val( '0' );
				$( '.bonusCost' ).html( '0₽' );
				$( '#chargeBonusBox span' ).html( 'Списать бонусы' );
				$( 'input[name=chargebonus]' ).prop( 'checked', false );
				$( '#couponDiscount' ).val( '1' );
				$( '#resetCouponBtn' ).addClass( 'hide' );
				$( '#applyCouponBtn' ).removeClass( 'hide' );
				$( '#applyCouponInfo' ).empty();
				$( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

                cartTotal();

                // Подарки - начало
				$( '.slider_scale_items .item' ).each( function( i )
				{
					var giftWeight = $(this).data( 'weight' );

                    var giftId = $(this).data( 'id' );

					if( resp.giftsum >= giftWeight )
					{
						if( $.cookie( 'giftid' ) == giftId )
						{
							$(this).find( '.button.c3' ).removeClass( 'hide' );
							$(this).find( '.button.c2' ).addClass( 'hide' );
						}
						else
						{
							$(this).find( '.button.c3' ).addClass( 'hide' );
							$(this).find( '.button.c2' ).removeClass( 'hide' );
						}

						$(this).find( '.button.c1' ).addClass( 'hide' );
					}
					else
					{
						$(this).find( '.button.c3' ).addClass( 'hide' );
						$(this).find( '.button.c2' ).addClass( 'hide' );
						$(this).find( '.button.c1' ).removeClass( 'hide' );
					}
				});

				if( resp.giftnext > 0 )
				{
					$( '#nextSumBlock' ).removeClass( 'hide' );
					$( '#nextSumFull' ).addClass( 'hide' );
				}
				else
				{
					$( '#nextSumBlock' ).addClass( 'hide' );
					$( '#nextSumFull' ).removeClass( 'hide' );
				}

				if( parseInt($.cookie( 'giftweight' )) > parseInt(resp.giftsum) )
				{
                    $.cookie( 'giftid', 0 );
                    $.cookie( 'giftcost', 0 );
					$.cookie( 'giftweight', 0 );
				}
				// Подарки - конец

				if( resp.data <= 0 )
				{
					$( '.cart' ).addClass( 'hide' );
					$( '.emptyCart' ).removeClass( 'hide' );
				}
			} else {
				if( resp.all < 1 )
				{
					btn.parent().parent().find( '.button-passive' ).removeClass( 'hide' );
					btn.parent().parent().find( '.button-active' ).addClass( 'hide' );
				}
                else
                {
                    if( cid != resp.cart_id )
                    {
                        btn.attr( 'data-cid', resp.cart_id );

                        btn.data( 'cid', resp.cart_id );
                    }
                }
			}
		});
	});

	// изменение кол-ва позиции
	$('.button_group .minus, .button_group .plus').on('click', function(e){
		let parent = $(this).parent(),
			current_value = parseInt(parent.find('.kolvo span').text()),
			type_way = $(this).hasClass('minus') ? 'minus' : 'plus',
			value_check = parent.hasClass('quantity_product') ? 1 : 0,
			max = $(this).closest('.mod_group').data('max'),
			group_id = $(this).closest('.mod_group').prop('id');
		if(type_way === 'minus') {
			if(current_value > value_check) {
				current_value--;
			}
		} else {
			// проверяем лимиты для допов default
			let total_current_value = 0;
			$.each($('.modifiers .mod_group.default#'+group_id+' .mod_item'), function(){
				total_current_value += parseInt($(this).find('.kolvo span').text());
			});
			if(total_current_value === max) {
				alert('Вы достигли максимума для этой группы модификации. Max = '+max);
				e.preventDefault();
				return false;
			}
			current_value++;
		}
		parent.find('.kolvo span').text(current_value);
		cart_product_update();
		return false;
	});

	$('.modifiers .mod_group.multiple, .modifiers .mod_group.single').on('change', function(){
		cart_product_update();
	});

	// проверяем лимиты для допов multiple
	$('.modifiers .mod_group.multiple input').on('click', function(e){
		let max = $(this).closest('.mod_group').data('max'),
			group_id = $(this).closest('.mod_group').prop('id'),
			this_checked = $('.modifiers .mod_group.multiple#'+group_id+' input:checked').length;
		if((this_checked-1) === max) {
			alert('Вы достигли максимума для этой группы модификации. Max = '+max);
			e.preventDefault();
			return false;
		}
	});

	// функция обновления стоимости на странице карточки товара
	function cart_product_update() {
		let poz_cost = parseInt($('.item_weight input').val()),
			poz_quantity = parseInt($('.final_cost_bar .quantity .kolvo span').text());

		if(typeof($('.item_weight input').val()) === 'undefined') {
			poz_cost = parseInt($('.item_weight select').val());
		}
		// собираем выбранные модификаторы
		let mod_cost = 0;
		if(typeof($('.modifiers .mod_group.multiple')) !== 'undefined') {
			$.each($('.modifiers .mod_group.multiple input:checked'), function(){
				mod_cost += parseInt($(this).val());
			});
		}
		if(typeof($('.modifiers .mod_group.single')) !== 'undefined') {
			$.each($('.modifiers .mod_group.single input:checked'), function(){
				mod_cost += parseInt($(this).parent().find('.cost').text());
			});
		}
		if(typeof($('.modifiers .mod_group.default')) !== 'undefined') {
			$.each($('.modifiers .mod_group.default .mod_item'), function(){
				let current_value = parseInt($(this).find('.kolvo span').text());
				if(current_value > 0) {
					mod_cost += current_value*parseInt($(this).find('.cost').text());
				}
			});
		}
		let final_cost = (poz_cost+mod_cost)*poz_quantity;
		$('.final_cost').text(final_cost);
	}

	// функция сброса стоимости и модификаторов на странице карточки товара
	function cart_product_reset(btn) {
		btn.parent().find('.order_info').addClass('hide');
		btn.removeClass('hide');
		$('.final_cost_bar .quantity .kolvo span').text(1);
		// сбрасываем допы
		if(typeof($('.modifiers .mod_group.multiple')) !== 'undefined') {
			$.each($('.modifiers .mod_group.multiple input'), function(){
				$(this).prop('checked','');
			});
		}
		let for_check = [];
		if(typeof($('.modifiers .mod_group.single')) !== 'undefined') {
			$.each($('.modifiers .mod_group.single input'), function(index){
				for_check.push($(this).prop('name'));
				$(this).prop('checked','');
			});
			$.each(for_check, function(index, value){
				$('.modifiers .mod_group.single input[name='+value+']').eq(0).prop('checked','checked');
			});
		}
		if(typeof($('.modifiers .mod_group.default')) !== 'undefined') {
			$.each($('.modifiers .mod_group.default .mod_item'), function(){
				$(this).find('.kolvo span').text(0);
			});
		}
	}

    /* RCMD - Start */

    $( 'body' ).on( 'click', '.addRcmd', function()
	{
        let btn = $(this),
			id = btn.data( 'id' ),
			price = btn.data( 'price' ),
			poz_quantity = 1,
			external_id = btn.data( 'external_id' );

        let mod_cost = 0,
			mods = [];

        $.post( 'ajax.php?do=addcart', 'id=' + id + '&external_id='+external_id+'&price=' + price + '&quantity='+poz_quantity+'&mods='+JSON.stringify(mods), function( msg )
		{
			let resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

            $( '#rcmd-' + id ).addClass( 'active' );

            $( '#rcmd-' + id + ' .addRcmd' ).addClass( 'hide' );

            $( '#rcmd-' + id + ' .issetRcmd' ).removeClass( 'hide' );

            if( $( ".slider_recommend .slider_item:visible" ).length < 1 )
            {
                $( '#title_recommend' ).hide();
            }

            $( 'span.basketPrice' ).html( resp.data + '₽' );

            $( '#total' ).val( resp.data );

            $( '#dtotal' ).val( resp.dtotal );

            $( '.orderCost span, .orderCost2 span' ).html( resp.data );

            $( '.order span' ).html( resp.data );

            $( '#bonusCost' ).val( '0' );
			$( '.bonusCost' ).html( '0₽' );
			$( '#chargeBonusBox span' ).html( 'Списать бонусы' );

			$( 'input[name=chargebonus]' ).prop( 'checked', false );

            $( '#couponDiscount' ).val( '1' );

            $( '#resetCouponBtn' ).addClass( 'hide' );

            $( '#applyCouponBtn' ).removeClass( 'hide' );

            $( '#applyCouponInfo' ).empty();

            $( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

            cartTotal();

            let html = '<div class="cart_item">' +

                '<div class="image">' +
                    '<img class="lazyImg" src="' + resp.img + '" data-original="' + resp.img + '">' +
                '</div>' +

                '<div class="product">' +
                    '<p class="cat">' + resp.category + '</p>' +
                    '<h3 class="title">' + resp.title + '</h3>' +
				'</div>' +

                '<div class="button">' +
                    '<div class="updateCart minus" data-cid="' + resp.key + '" data-type="-"><span>-</span></div>' +
                    '<div class="kolvo"><span>1</span></div>' +
                    '<div class="updateCart plus" data-cid="' + resp.key + '" data-type="+"><span>+</span></div>	' +
                '</div>' +

                '<div class="calc">' +
                    '<p class="formula"><span>1</span> х '+price+'₽</p>' +
                    '<h3 class="result">'+price+'₽</h3>' +
                '</div>' +

                '<div class="clear">' +
				    '<a href="javascript:void(0);" class="removeCart" data-cid="' + resp.key + '" data-id="' + id + '">' +
				        '<img src="images/icons/ic_clear.png" width="32px">' +
				    '</a>' +
                '</div>' +

            '</div>';

            $( '#cart-list' ).append( html );

            // Подарки - начало
			$( '#nextGiftSum span' ).html( resp.giftnext );

			$( '#giftRange' ).css( 'width', resp.giftprc + '%' );
			// Подарки - конец
        });
    });

    /* RCMD - End */

	$( 'body' ).on( 'click', '.addToCart', function()
	{
		let btn = $(this),
			id = btn.data( 'id' ),
			price = parseInt($( '#price-' + id ).val()),
			poz_quantity = parseInt($('.final_cost_bar .quantity .kolvo span').text()),
			selected_val = $( '#price-' + id +' option:selected'),
			external_id = $( '#price-' + id).data('external_id');
		// если есть разновидность товара из списка
		if(typeof(selected_val.data('external_id')) !== 'undefined') {
			external_id = selected_val.data('external_id');
		}
		let mod_cost = 0,
			mods = [];
		if(typeof($('.modifiers .mod_group.multiple')) !== 'undefined') {
			$.each($('.modifiers .mod_group.multiple input:checked'), function(){
				mod_cost += parseFloat($(this).val()); // Fix 23.10.2021
				mods.push($(this).prop('id')+';'+$(this).parent().parent().find('.title').text()+';'+$(this).val()+'₽'+';;'+$(this).parent().parent().find('.title').data( 'external_id' ) ); // Updates 09.11.2021
			});
		}
		if(typeof($('.modifiers .mod_group.single')) !== 'undefined') {
			$.each($('.modifiers .mod_group.single input:checked'), function(){
				mod_cost += parseFloat($(this).parent().find('.cost').text()); // Fix 23.10.2021
				mods.push($(this).prop('id')+';'+$(this).parent().find('.title').text()+';'+$(this).parent().find('.cost').text()+';;'+$(this).parent().find('.title').data( 'external_id' ) ); // Updates 09.11.2021
			});
		}
		if(typeof($('.modifiers .mod_group.default')) !== 'undefined') {
			$.each($('.modifiers .mod_group.default .mod_item'), function(){
				let current_value = parseFloat($(this).find('.kolvo span').text());
				if(current_value > 0) {
					mod_cost += current_value*parseFloat($(this).find('.cost').text()); // Fix 23.10.2021
					mods.push($(this).prop('id')+';'+$(this).find('.title').text()+';'+$(this).find('.cost').text()+';'+current_value+';'+$(this).find('.title').data( 'external_id' ) ); // Updates 09.11.2021
				}
			});
		}
		price += mod_cost;

		$.post( 'ajax.php?do=addcart', 'id=' + id + '&external_id='+external_id+'&price=' + price + '&quantity='+poz_quantity+'&mods='+JSON.stringify(mods), function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			//if(parseInt(external_id) !== 0) {
			//if(parseInt(external_id) !== 0 && mods.length > 0) {
			if(btn.hasClass('addToCart_mods')) {
				btn.addClass( 'hide' );
				btn.parent().find('.order_info').removeClass('hide').html('<h3>Товар успешно добавлен</h3>');
				// сбрасываем выбранные данные
				setTimeout(function(){
					cart_product_reset(btn);
					cart_product_update();
					// cid type
					//btn.prop('data-cid', id).prop('type', '+').addClass('updateCart');
				}, 1500);
			} else {
				btn.parent().addClass( 'hide' );
				btn.parent().parent().find( '.button-active' ).removeClass( 'hide' );
				btn.parent().parent().find( '.button-active .kolvo' ).text( 1 );
				btn.parent().parent().find( '.button-active .minus' ).attr('data-cid', resp.key);
				btn.parent().parent().find( '.button-active .plus' ).attr('data-cid', resp.key);
			}

			$( 'span.basketPrice' ).html( resp.data + '₽' );

			$( '#couponDiscount' ).val( 1 );

			$( '#applyCouponInfo' ).empty();

			$( '#applyCouponInfo' ).removeClass( 'text-info text-error' );

            // Подарки - начало
			$( '#nextGiftSum span' ).html( resp.giftnext );

			$( '#giftRange' ).css( 'width', resp.giftprc + '%' );
			// Подарки - конец
		});
	});

	$( '#r1' ).on( 'change', function()
	{
		if( $(this).prop( 'checked' ) )
		{
			$.cookie( 'dlvr', 1 );

            $( '.orderDiscount2 span' ).html( 0 );

            $( '.deliveryCostBtm' ).parent().css( 'display', '' );

            $( '.orderDiscount2' ).css( 'display', 'none' );

            $.post( 'ajax.php?do=resetcoupon', function( msg )
            {
                resp = JSON.parse( msg );

                if( resp.status == 0 )
                {
                    $( '#applyCouponInfo' ).addClass( 'text-error' );

                    $( '#applyCouponInfo' ).html( resp.data );

                    return false;
                }

                $( '#applyCouponInfo' ).empty();

                $( '#couponDiscount' ).val( '1' );

                $( '#resetCouponBtn' ).addClass( 'hide' );

                $( '#applyCouponBtn' ).removeClass( 'hide' );

                $( 'input[name=couponCode]' ).val( '' );

                cartTotal();
            });
		}
	});

	$( '#r2' ).on( 'change', function()
	{
		if( $(this).prop( 'checked' ) )
		{
			$( '.deliveryCost' ).html( '+ 0₽' );
			$( '.deliveryCostBtm' ).html( '0₽' );

			$.cookie( 'dlvr', 2 );

            $( '.deliveryCostBtm' ).parent().css( 'display', 'none' );

            $( '.orderDiscount2' ).css( 'display', '' );

            $.post( 'ajax.php?do=resetcoupon', function( msg )
            {
                resp = JSON.parse( msg );

                if( resp.status == 0 )
                {
                    $( '#applyCouponInfo' ).addClass( 'text-error' );

                    $( '#applyCouponInfo' ).html( resp.data );

                    return false;
                }

                $( '#applyCouponInfo' ).empty();

                $( '#couponDiscount' ).val( '1' );

                $( '#resetCouponBtn' ).addClass( 'hide' );

                $( '#applyCouponBtn' ).removeClass( 'hide' );

                $( 'input[name=couponCode]' ).val( '' );

                cartTotal();
            });
		}
	});

	$( 'body' ).on( 'change', '.modItem', function()
	{
		let sel = $(this),
			prnt = sel.parent().parent().parent(),
			id = prnt.find( '.addToCart' ).data( 'id' ),
			href = prnt.find( '.addToCart' ).prop( 'href' ),
			price = sel.val(),
			external_id = sel.find('option:selected').data('external_id');//,
            //with_dops = prnt.find( '.addToCart' ).hasClass('addToCart_mods');
		prnt.find( '.item_cost .cost, .cost-line .cost' ).html( price + '₽' );
		prnt.find( '.final_cost' ).html( price );
		// если товар с допами, то ищем id в другом месте
		if(typeof(id) === 'undefined') {
			id = prnt.find( '.addToCart_a' ).data( 'id' );
			href = prnt.find( '.addToCart_a' ).prop( 'href' );
		}
		//console.log(prnt.find( '.final_cost' ).length);
		$.post( 'ajax.php?do=checkcart', 'id=' + id+ '&external_id='+external_id, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			//if(with_dops === 0) {
            if(prnt.find( '.final_cost' ).length === 0) {
                if( resp.data > 0 )
                {
                    prnt.find( '.button-passive' ).addClass( 'hide' );
                    prnt.find( '.button-active' ).removeClass( 'hide' );
                    prnt.find( '.button-active .kolvo' ).html( resp.data );
                } else {
                    prnt.find( '.button-passive' ).removeClass( 'hide' );
                    prnt.find( '.button-active' ).addClass( 'hide' );
                }
            }
			// меняем хеш в урле
			if(typeof(href) !== 'undefined') {
				let hash_new = sel.find('option:selected').data('external_id'),
					hash_old = href.split('#');
				prnt.find( '.addToCart_a, .updateCart_fake, .image a, .item_photo a, .text a:eq(0)' ).prop('href', hash_old[0]+'#'+hash_new);
			}

			//prnt.find( '.updateCart' ).data( 'cid', cid );
			if(typeof(resp.cart_id) !== 'undefined') {
				prnt.find('.updateCart').attr('data-cid', resp.cart_id);
			}
		});
	});

	$( 'body' ).on( 'click', '.removeCart', function()
	{
		let btn = $(this);
		let cid = btn.data( 'cid' );
        let id = btn.data( 'id' );

		$.post( 'ajax.php?do=removecart', 'cid=' + cid, function( msg )
		{
			let resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				alert( resp.data );
				return false;
			}

			btn.parent().parent().fadeOut(500);

			$( 'span.basketPrice' ).html( resp.data + '₽' );

            // Подарки - начало
            $( '#nextGiftSum span' ).html( resp.giftnext );

            $( '#giftRange' ).css( 'width', resp.giftprc + '%' );
            // Подарки - конец

			if( $( '.orderCost span' ).length )
			{
				$( '#total' ).val( resp.data );
                $( '#dtotal' ).val( resp.dtotal );
				$( '.orderCost span, .orderCost2 span' ).html( resp.data );
				$( '.order span' ).html( resp.data );
				$( '#bonusCost' ).val( '0' );
				$( '.bonusCost' ).html( '0₽' );
				$( '#chargeBonusBox span' ).html( 'Списать бонусы' );
				$( '#couponDiscount' ).val( '1' );
				$( '#resetCouponBtn' ).addClass( 'hide' );
				$( '#applyCouponBtn' ).removeClass( 'hide' );
				$( '#applyCouponInfo' ).empty();
				$( '#applyCouponInfo' ).removeClass( 'text-info text-error' );
				$( 'input[name=chargebonus]' ).prop( 'checked', false );

				cartTotal();

                /* RCMD - Start */
                $( '#rcmd-' + id ).removeClass( 'active' );

                $( '#rcmd-' + id + ' .addRcmd' ).removeClass( 'hide' );

                $( '#rcmd-' + id + ' .issetRcmd' ).addClass( 'hide' );

                $( '#title_recommend' ).show();

                /* RCMD - End */

                // Подарки - начало
				$( '.slider_scale_items .item' ).each( function( i )
				{
					var giftWeight = $(this).data( 'weight' );

                    var giftId = $(this).data( 'id' );

					if( resp.giftsum >= giftWeight )
					{
						if( $.cookie( 'giftid' ) == giftId )
						{
							$(this).find( '.button.c3' ).removeClass( 'hide' );
							$(this).find( '.button.c2' ).addClass( 'hide' );
						}
						else
						{
							$(this).find( '.button.c3' ).addClass( 'hide' );
							$(this).find( '.button.c2' ).removeClass( 'hide' );
						}

						$(this).find( '.button.c1' ).addClass( 'hide' );
					}
					else
					{
						$(this).find( '.button.c3' ).addClass( 'hide' );
						$(this).find( '.button.c2' ).addClass( 'hide' );
						$(this).find( '.button.c1' ).removeClass( 'hide' );
					}
				});

				if( resp.giftnext > 0 )
				{
					$( '#nextSumBlock' ).removeClass( 'hide' );
					$( '#nextSumFull' ).addClass( 'hide' );
				}
				else
				{
					$( '#nextSumBlock' ).addClass( 'hide' );
					$( '#nextSumFull' ).removeClass( 'hide' );
				}

				if( $.cookie( 'giftweight' ) > resp.giftsum )
				{
                    $.cookie( 'giftid', 0 );
                    $.cookie( 'giftcost', 0 );
					$.cookie( 'giftweight', 0 );
				}
				// Подарки - конец

				if( resp.data <= 0 )
				{
					$( '.cart' ).addClass( 'hide' );
					$( '.emptyCart' ).removeClass( 'hide' );
				}
			}
		});
	});

	$( 'body' ).on( 'click', '.order', function()
	{
		error = 0;

		$( '.text-error' ).empty();
		$( 'input' ).removeClass( 'error' );

		if( $( '#r1' ).prop( 'checked' ) )
		{
			locations = $( 'select[name=locations]' );

			if( locations.val().length < 1 )
			{

			}

			street = $( 'input[name=street]' );
			if( street.val().length < 1 )
			{
				street.addClass( 'error' );
				street.parent().find( '.text-error' ).html( 'Не указан Адрес доставки' );
				$( 'html, body' ).animate({ scrollTop: $(street).offset().top-105 }, 500);
				street.focus();

				error = 1;
			}

			home = $( 'input[name=home]' );
			if( home.val().length < 1 )
			{
				home.addClass( 'error' );
				home.parent().find( '.text-error' ).html( 'Не указан Адрес доставки' );
				$( 'html, body' ).animate({ scrollTop: $(home).offset().top-105 }, 500);
				home.focus();

				error = 1;
			}

			/* Запоминание адреса */
			localStorage.setItem( 'locations', $( 'input[name=locations]' ).val() );
			localStorage.setItem( 'street', $( 'input[name=street]' ).val() );
			localStorage.setItem( 'home', $( 'input[name=home]' ).val() );
			localStorage.setItem( 'entrance', $( 'input[name=entrance]' ).val() );
			localStorage.setItem( 'floor', $( 'input[name=floor]' ).val() );
			localStorage.setItem( 'apart', $( 'input[name=apart]' ).val() );
			/**/

		}
		else if( $( '#r2' ).prop( 'checked' ) )
		{
			points = $( 'select[name=points]' );

			if( points.val().length < 1 )
			{

			}
		}
		else
		{
			$( '#cartMsg' ).html( 'Не выбран способ получения заказа' );
			error = 1;
		}

		localStorage.setItem( 'uname', $( 'input[name=uname]' ).val() );
		localStorage.setItem( 'phone', $( 'input[name=phone]' ).val() );

		uname = $( 'input[name=uname]' );

		if( uname.val().length < 1 )
		{
			uname.addClass( 'error' );
			uname.parent().find( '.text-error' ).html( 'Не указано Ваше имя' );
			error = 1;
		}

		phone = $( 'input[name=phone]' );

		if( phone.val().length < 1 )
		{
			phone.addClass( 'error' );
			phone.parent().find( '.text-error' ).html( 'Не указан Контактный номер' );
			error = 1;
		}

		if( error == 1 )
		{
			$( '#cartMsg' ).html( 'Проверьте правильность заполнения отмеченных полей' );
			return false;
		}

		formData = $( 'div.cart input, div.cart select, div.cart textarea' ).serialize();

		$( '.loaderCartImg' ).removeClass( 'hide' );
		$( '.buttonText' ).addClass( 'hide' );

		$.post( 'ajax.php?do=order', formData, function( msg )
		{
			$( '.loaderCartImg' ).addClass( 'hide' );
			$( '.buttonText' ).removeClass( 'hide' );

			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				$( '#cartMsg' ).html( resp.data );
				return false;
			}
            /* Подарки - начало */
            $.cookie( 'giftid', 0 );
            $.cookie( 'giftcost', 0 );
            $.cookie( 'giftweight', 0 );
            /* Подарки - конец */

            window.location.href = 'cart_order_info.php' + page_query;
		});
	});

	$( 'body' ).on( 'click', '#cleanCartBtn', function()
	{
		$.post( 'ajax.php?do=cleancart', function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				$( '#cartMsg' ).html( resp.data );
				return false;
			}
			$( 'span.basketPrice' ).html( '0₽' );
			$( '.cart' ).addClass( 'hide' );
			$( '.emptyCart' ).removeClass( 'hide' );
			$( '#modal-0' ).removeClass( 'md-show' );

            /* Подарки - начало */
            $.cookie( 'giftid', 0 );
            $.cookie( 'giftcost', 0 );
            $.cookie( 'giftweight', 0 );
            /* Подарки - конец */
		});
	});

















	/* Для выбора даты и времени */

	if( $( '#dtDate' ).length )
	{
		var dDate = $( '#dtDate' ).val();

		var dTime = $( '#dtTime' ).val();

		var pattern = /(\d{2})\.(\d{2})\.(\d{4})/;

		var dDate = dDate.replace(pattern,'$3-$2-$1');

		var date = new Date( dDate + 'T' + dTime + '+03:00' );

		var firstDate = new Date();

        firstDate.setHours( firstDate.getHours() + 3 );

		var different = date - firstDate;

		var diffhours = different / 3600000;

		var dateMin = new Date( $( '#dTimeMin' ).val() );

		if( date < dateMin )
		{
            var allowDate = dateMin;

			if( allowDate.getMinutes() >= 30 )
			{
				var allowTime = allowDate.getHours() + ':30';

				if( allowDate.getMinutes() > 30 )
				{
					var allowTime = parseInt( allowDate.getHours() + 1 ) + ':00';
				}
			}
			else
			{
				var allowTime = allowDate.getHours() + ':00';

				if( allowDate.getMinutes() > 0 )
				{
					var allowTime = allowDate.getHours() + ':30';
				}
			}

			$( '#dtTime option' ).each( function( indx, element )
			{
  				if( $(this).text() == allowTime )
				{
					$( '#dtTime' ).val( allowTime );

					date = new Date( dDate + 'T' + allowTime + '+03:00' );

					return false;
				}

				$(this).attr( 'disabled', 'disabled' );
			});
		}
		else
		{
			$( '#dtTime option' ).removeAttr( 'disabled' );
		}

		var month = date.getMonth() + 1;

		month = ('0'+month).slice(-2);

		var hours2 = date.getHours() + 1;

		var mins = ('0'+date.getMinutes()).slice(-2);

		var infoText = date.getDate()  + '.' + month + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + mins + ' до ' + hours2 + ':' + mins;

		$( '#deliveryTimeInfo' ).html( infoText );
	}

	$( 'body' ).on( 'change', '#dtDate', function()
	{
		var dDate = $( '#dtDate' ).val();

		var dTime = $( '#dtTime' ).val();

		var pattern = /(\d{2})\.(\d{2})\.(\d{4})/;

		var dDate = dDate.replace(pattern,'$3-$2-$1');

		var date = new Date( dDate + 'T' + dTime + '+03:00' );

		var dateMin = new Date( $( '#dTimeMin' ).val() );

		var stDay = new Date( dDate + 'T' + '00:00' + '+03:00' );

		if( stDay < dateMin )
		{
			var allowDate = dateMin;

			if( allowDate.getMinutes() >= 30 )
			{
				var allowTime = allowDate.getHours() + ':30';

				if( allowDate.getMinutes() > 30 )
				{
					var allowTime = parseInt( allowDate.getHours() + 1 ) + ':00';
				}
			}
			else
			{
				var allowTime = allowDate.getHours() + ':00';

				if( allowDate.getMinutes() > 0 )
				{
					var allowTime = allowDate.getHours() + ':30';
				}
			}

			$( '#dtTime option' ).each( function( indx, element )
			{
  				if( $(this).text() == allowTime )
				{
					$( '#dtTime' ).val( allowTime );

					date = new Date( dDate + 'T' + allowTime + '+03:00' );

					return false;
				}

				$(this).attr( 'disabled', 'disabled' );
			});
		}
		else
		{
			$( '#dtTime option' ).removeAttr( 'disabled' );
		}

		var month = date.getMonth() + 1;

		month = ('0'+month).slice(-2);

		var hours2 = date.getHours() + 1;

		var mins = ('0'+date.getMinutes()).slice(-2);

		var infoText = date.getDate()  + '.' + month + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + mins + ' до ' + hours2 + ':' + mins;

		$( '#deliveryTimeInfo' ).html( infoText );

        $( '#dtTime option' ).removeAttr( 'selected' );
	});

	$( 'body' ).on( 'change', '#dtTime', function()
	{
		var dDate = $( '#dtDate' ).val();

		var dTime = $( '#dtTime' ).val();

		var pattern = /(\d{2})\.(\d{2})\.(\d{4})/;

		var dDate = dDate.replace(pattern,'$3-$2-$1');

		var dTimeFrom = $( '#dTimeFrom' ).val().split( ':' );

		var dTimeTo = $( '#dTimeTo' ).val().split( ':' );

		var date = new Date( dDate + 'T' + dTime + '+03:00' );

		var dateMin = new Date( $( '#dTimeMin' ).val() );

		if( date < dateMin )
		{
			date = dateMin;
		}

		var month = date.getMonth() + 1;

		month = ('0'+month).slice(-2);

		var hours2 = date.getHours() + 1;

		var mins = ('0'+date.getMinutes()).slice(-2);

		var infoText = date.getDate()  + '.' + month + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + mins + ' до ' + hours2 + ':' + mins;

		$( '#deliveryTimeInfo' ).html( infoText );
	});
	/* ----- ----- ----- */

    // Подарки - начало
	$( 'body' ).on( 'click', '.item .button.c2', function()
	{
		var id = $(this).data( 'id' );

        var cost = $(this).data( 'cost' );

        var weight = $(this).data( 'weight' );

        var total = parseFloat( $( '#total' ).val() );

        var dtotal = parseFloat( $( '#dtotal' ).val() );

        if( $.cookie( 'giftcost' ) > 0 )
        {
            total = parseFloat(total) - parseInt($.cookie( 'giftcost' ));

            dtotal = parseFloat(dtotal) - parseInt($.cookie( 'giftcost' ));
        }

		$.cookie( 'giftid', id );
        $.cookie( 'giftcost', cost );
        $.cookie( 'giftweight', weight );

        if( cost > 0 )
        {
            total = total + parseFloat(cost);

            dtotal = dtotal + parseFloat(cost);
        }

		$( '.slider_scale_items .item' ).each( function( i )
		{
			if( $(this).find( '.button.c1' ).hasClass( 'hide' ) )
			{
				$(this).find( '.button.c3' ).addClass( 'hide' );
				$(this).find( '.button.c2' ).removeClass( 'hide' );
			}
		});

		$(this).addClass( 'hide' );

		$(this).parent().find( '.button.c3' ).removeClass( 'hide' );

        if( $( '.orderCost span' ).length )
        {
            $( '#total' ).val( total );
            $( '#dtotal' ).val( dtotal )
            $( '.orderCost span, .orderCost2 span' ).html( total );

            cartTotal();

            /* RCMD - Start */
            $( '#rcmd-' + id ).removeClass( 'active' );

            $( '#rcmd-' + id + ' .addRcmd' ).removeClass( 'hide' );

            $( '#rcmd-' + id + ' .issetRcmd' ).addClass( 'hide' );

            $( '#title_recommend' ).show();

            /* RCMD - End */
        }
	});

    $( 'body' ).on( 'click', '#selectGiftOpen', function()
	{
		$(this).addClass( 'hide' );

		$( '#selectGiftClose' ).removeClass( 'hide' );

		$( '#giftsList' ).removeClass( 'hide' );
	});

	$( 'body' ).on( 'click', '#selectGiftClose', function()
	{
		$(this).addClass( 'hide' );

		$( '#selectGiftOpen' ).removeClass( 'hide' );

		$( '#giftsList' ).addClass( 'hide' );
	});
	// Подарки - конец

    if( $( '#deliveryMethod' ).length )
    {
        var discount = $('#pickup-points').find( 'option:selected' ).data( 'discount' );

        var fdsc = ( discount > 0 ) ? discount * 100 : 0;

        $( 'label[for=r2] span, #pickup-discount span' ).html( fdsc );

        cartTotal();
    }
});




function b64DecodeUnicode(str) {
    return decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    }).join(''))
}
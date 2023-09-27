var page_query = $('div.page_query').data('page_query');

$(function()
{
	$( 'body' ).on( 'click', '.mobLogWin .button', function(e)
	{
		e.preventDefault();

		btn = $( '.mobLogWin .submit' );

		$( '.mobLogWin div.error' ).empty();

		$( '.mobLogWin div.error' ).hide();

		phone = $( '.mobLogWin input[name=phone]' ).val();

		if( phone.length < 1 )
		{
			$( '.mobLogWin input[name=phone]' ).addClass( '' );

			return false;
		}

		if( !$( 'input[name=agree]' ).is( ':checked' ) )
		{
			$( '.mobLogWin div.error' ).html( 'Необходимо принять условия' );

			$( '.mobLogWin div.error' ).show();

			return false;
		}

		$( '.mobLogWin .loaderImg' ).removeClass( 'hide' );

		btn.hide();

		$.post( 'user/ajax.php?do=sms_code', 'phone=' + phone, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 )
			{
				$( '.mobLogWin .loaderImg' ).addClass( 'hide' );

				btn.show();

				$( '.mobLogWin div.error' ).html( resp.data );

				$( '.mobLogWin div.error' ).show();

				return false;
			}

			$( '.mobLogWin' ).fadeOut( 500 );

			setTimeout(function() { $( '.mobCodeWin' ).fadeIn( 500 ); }, 500 );
		});
	});

	/* Updated 25.03.2022 - start */
	$( 'body' ).on( 'keyup', '.mobCodeWin input[name=code]', function(e)
	{
		e.preventDefault();
		var btn = $( '.mobCodeWin .submit' );
		$( '.mobCodeWin div.error' ).empty();
		$( '.mobCodeWin div.error' ).hide();

		var code = $( '.mobCodeWin input[name=code]' ).val();

		if( code.length < 4 || code.length > 4 ) {
			return false;
		}

		$( '.mobCodeWin .loaderImg' ).removeClass( 'hide' );
		btn.hide();

		$.post( 'user/ajax.php?do=check_code', 'code=' + code, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 ) {
				$( '.mobCodeWin .loaderImg' ).addClass( 'hide' );
				btn.show();
				$( '.mobCodeWin div.error' ).html( resp.data );
				$( '.mobCodeWin div.error' ).show();
				return false;
			}

			$( '.mobCodeWin' ).fadeOut( 500 );

			if( resp.data == 'reg' ) {
				setTimeout(function() { $( '.mobRegWin' ).fadeIn( 500 ); }, 500 );

				return false;
			}

			window.location.href = 'user/' + page_query;
		});
	});
	/* Updated 25.03.2022 - end */

	$( 'body' ).on( 'click', '.mobCodeWin .button', function(e)
	{
		e.preventDefault();
		btn = $( '.mobCodeWin .submit' );
		$( '.mobCodeWin div.error' ).empty();
		$( '.mobCodeWin div.error' ).hide();

		code = $( '.mobCodeWin input[name=code]' ).val();

		if( code.length < 1 ) {
			$( '.mobCodeWin input[name=code]' ).addClass( 'error' );
			return false;
		}

		$( '.mobCodeWin .loaderImg' ).removeClass( 'hide' );
		btn.hide();

		$.post( 'user/ajax.php?do=check_code', 'code=' + code, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 ) {
				$( '.mobCodeWin .loaderImg' ).addClass( 'hide' );
				btn.show();
				$( '.mobCodeWin div.error' ).html( resp.data );
				$( '.mobCodeWin div.error' ).show();
				return false;
			}

			$( '.mobCodeWin' ).fadeOut( 500 );

			if( resp.data == 'reg' ) {
				setTimeout(function() { $( '.mobRegWin' ).fadeIn( 500 ); }, 500 );

				return false;
			}
			/* Updated 03.07.2022 - start */
			document.cookie = "auth_token=" + resp.token + "; path=/; max-age=86400000";
			/* Updated 03.07.2022 - end */

			window.location.href = 'user/' + page_query;
		});
	});

	$( 'body' ).on( 'click', '.mobRegWin .button', function(e)
	{
		e.preventDefault();
		btn = $( '.mobRegWin .submit' );
		name = $( '.mobRegWin input[name=name]' ).val();

		if( name.length < 1 ) {
			$( '.mobRegWin input[name=name]' ).addClass( 'error' );

			return false;
		}

		promocode = $( '.mobRegWin input[name=promocode]' ).val();
		$( '.mobRegWin .loaderImg' ).removeClass( 'hide' );

		btn.hide();
		/* Updated 03.07.2022 - start */
		$.post( 'user/ajax.php?do=register', 'name=' + name + '&promocode=' + promocode, function( msg )
		{
			resp = JSON.parse( msg );

			if( resp.status == 0 ) {
				$( '.mobRegWin .loaderImg' ).addClass( 'hide' );
				btn.show();
				alert( resp.data );
				return false;
			}

			$( '.mobRegWin' ).fadeOut( 500 );

			//setTimeout(function() { $( '.mobRegEndWin' ).fadeIn( 500 ); }, 500 );

			window.location.href = 'user/' + page_query;
		});
		/* Updated 03.07.2022 - end */
	});

	/*
	$( 'body' ).on( 'click', '.mobRegEndWin .button', function(e)
	{
		e.preventDefault();

		window.location.href = 'user/';
	});
	*/

	$( 'body' ).on( 'click', '#userLogout', function()	{
		//$( '.bAuthWin .loaderImg' ).removeClass( 'hide' );

		$.post( 'user/ajax.php?do=logout', '', function( msg )	{
			var resp = JSON.parse( msg );

			if( resp.status === 0 )	{
				//$( '.bAuthWin .loaderImg' ).addClass( 'hide' );
				alert( resp.data );
				return false;
			}

			window.location.reload();
		});
	});


});
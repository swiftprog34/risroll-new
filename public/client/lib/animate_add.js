//var add = new Audio('/files/.mp3');
//var remove = new Audio('/files/.mp3');

 if( window.innerWidth >= 800 ){
      var basket_area = $(".basket-area");
 } else {
      var basket_area = $(".basket-area-mobile");
 } 


$('.addToCart').on('click', function(){
	//add.play();

	var that = $(this).closest('.ani').find('img');
	var basket = $(basket_area);
	var h1 = that.height();
	var h2 = basket.height();	
       that.clone()
           .css({'width' : h1,
		'position' : 'absolute',
		'z-index' : '9999',
		top: that.offset().top,
		left:that.offset().left})
           .appendTo("body")
           .animate({opacity: 0.5,
                left: basket.offset()['left'],
                top: basket.offset()['top'],
                width: h2}, 500, function() {	
				$(this).remove();
				

			});
});

$('.aniplus').on('click', function(){
	//add.play();

	var that = $(this).closest('.ani').find('img');
	var basket = $(basket_area);
	var h1 = that.height();
	var h2 = basket.height();
       that.clone()
           .css({'width' : h1,
		'position' : 'absolute',
		'z-index' : '9999',
		top: that.offset().top,
		left:that.offset().left})
           .appendTo("body")
           .animate({opacity: 0.2,
               left: basket.offset()['left'],
               top: basket.offset()['top'],
               width: h2}, 300, function() {	
				$(this).remove();
			});
});


$('.animinus').on('click', function(){
	//remove.play();

	var that = $(basket_area);
	var product = $(this).closest('.ani').find('img');	
	var h1 = that.height();
	var h2 = product.height();	
       product.clone()
           .css({'width' : h1,
		'position' : 'absolute',
		'z-index' : '9999',
		top: that.offset().top,
		left:that.offset().left})
           .appendTo("body")
           .animate({opacity: 0.1,
               left: product.offset()['left'],
               top: product.offset()['top'],
               width: h2}, 300, function() {	
				$(this).remove();
			});
});
















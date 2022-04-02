$(function () {

'use strict';

 	//Switch betwee login and signup
 	$('.login-page h1 span').click(function() {

 		$(this).addClass('selected').siblings().removeClass('selected');
 		$('.login-page form').hide();
 		$('.' + $(this).data('class')).fadeIn(100);
 	});

	// add astrex etoile on required field
	$('input').each(function(){
		if ($(this).attr('required') ==='required') {
			$(this).after('<span class="astrex">*</span>')
		}

	});

	

	// confirmation message on button
	$('.confirm').click(function(){
		return confirm('Are You Sure');
	});

}); 
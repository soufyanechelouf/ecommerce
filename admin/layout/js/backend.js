$(function () {

'use strict';

// dashboard 
$('.toggle-info').click(function() {
	$(this).parent().next('.panel-body').fadeToggle(100);
});
//hide place holder on form focus
	$('[placeholder]').focus(function () {
		$(this).attr('data-text',$(this).attr('placeholder'));
		$(this).attr('placeholder','');
	}).blur(function (){

			$(this).attr('placeholder',$(this).attr('data-text'));
	    });

	// add astrex etoile on required field
	$('input').each(function(){
		if ($(this).attr('required') ==='required') {
			$(this).after('<span class="astrex">*</span>')
		}

	});

	//convert password field to text field on hover
	var passField = $('.password');
	$('.show-pass').hover(function(){

		passField.attr('type','text');
	},function (){

		passField.attr('type','password');
	});

	// confirmation message on button
	$('.confirm').click(function(){
		return confirm('Are You Sure');
	});

}); 